<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	deleteSelectedUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function deleteSelectedUser(){
	global $con;

	$emailAddress = $_GET['user_emailAddress'];

	$query = "DELETE FROM tblusers WHERE EmailAddress=?";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"s",$emailAddress);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "User successfully deleted!";
	}else{
		echo "No changes can be made!";
	}

	mysqli_stmt_close($stmt); 
	mysqli_close($con);
}
?>