<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	deleteRequestForPosition();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function deleteRequestForPosition(){
	global $con;

	$requestedBy = $_GET['requestedBy'];

	$query = "DELETE FROM tblrequests WHERE RequestedBy=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"s",$requestedBy);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Request for position successfully deleted!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>