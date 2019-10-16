<?php

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	checkIfEmailExists();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function checkIfEmailExists(){
	global $con;

	$emailAddress = $_GET['emailAddress'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblusers WHERE EmailAddress='$emailAddress'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    $infoOfUser = array();

	if($numrows==0){
		echo "invalid";
	}else{
		while($row = mysqli_fetch_assoc($queryToDetectIfExisting)){
			$row['UserID'] = bin2hex($row['UserID']);
			$infoOfUser[] = $row;
		}

		echo json_encode(array("infoOfUser"=>$infoOfUser));
	}

	mysqli_close($con);
}

?>