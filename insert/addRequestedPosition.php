<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	addRequestedPosition();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addRequestedPosition(){
	global $con;

	$requestedBy = $_POST['requestedBy'];
	$requestStatus = "Pending";
	$requestedPosition = $_POST['requestedPosition'];
	$requesterBarangay = $_POST['requesterBarangay'];
	$requestDateAndTimeRegistered = $_POST['requestDateAndTimeRegistered'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblrequests WHERE RequestedBy='$requestedBy' AND RequestStatus='$requestStatus'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblrequests(RequestedBy,RequestStatus,RequestedPosition,RequesterBarangay,RequestDateAndTimeRegistered) VALUES (?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"sssss",$requestedBy,$requestStatus,$requestedPosition,$requesterBarangay,$requestDateAndTimeRegistered);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Your request has been successfully submitted!";
		}else{
			echo "Failed to submit your request!";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "You have existing request. Please wait to confirm it!";
    }

	mysqli_close($con);
}

?>