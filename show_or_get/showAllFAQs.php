<?php
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllFAQs();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllFAQs(){
	global $con;

	$query="SELECT * FROM tblfaq ORDER BY ID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfFAQs = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfFAQs[] = $row;
		}

		echo json_encode(array("FAQs"=>$listOfFAQs));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>