<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	getAllAvailableBarangay();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function getAllAvailableBarangay(){
	global $con;

	$query="SELECT BarangayName FROM tblbarangay";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfBarangay = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfBarangay[] = $row;
		}

		header('Content-Type: application/json');
		echo json_encode(array("barangay"=>$listOfBarangay));
	}else{
		echo "No record found!";
	}

	mysqli_close($con);
}

?>