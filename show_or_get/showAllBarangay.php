<?php
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllUsers();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllUsers(){
	global $con;

	$query="SELECT * FROM tblbarangay";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfBarangay = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfBarangay[] = $row;
		}

		echo json_encode(array("barangay"=>$listOfBarangay));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>