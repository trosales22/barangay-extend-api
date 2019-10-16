<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	deleteSelectedBarangay();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function deleteSelectedBarangay(){
	global $con;

	$barangayID = $_GET['barangayID'];

	$query = "DELETE FROM tblbarangay WHERE BarangayID=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"s",$barangayID);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Barangay was successfully deleted!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>