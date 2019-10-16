<?php
header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllRequestBasedOnStatus();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllRequestBasedOnStatus(){
	global $con;

	$requestStatus = $_GET['requestStatus'];
	$requesterBarangay = $_GET['requesterBarangay'];
	$requestedPosition = $_GET['requestedPosition'];

	$query="SELECT * FROM tblrequests WHERE RequestStatus='$requestStatus' AND RequesterBarangay='$requesterBarangay' AND RequestedPosition='$requestedPosition' ORDER BY RequestID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfRequests = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$userID = $row['RequestedBy'];

			$listOfRequests[] = $row;

			$queryForGettingInfoOfRequest = "SELECT Firstname,Lastname,ProfilePicture,UserType FROM tblusers WHERE HEX(UserID)='$userID'";
			$resultForGettingInfoOfRequest = mysqli_query($con,$queryForGettingInfoOfRequest);
			$numrowsForGettingInfoOfRequest = mysqli_num_rows($resultForGettingInfoOfRequest);

			$infoOfRequester = array();

			if($numrowsForGettingInfoOfRequest > 0){
				while($rowForGettingInfoOfRequest = mysqli_fetch_assoc($resultForGettingInfoOfRequest)){
					$infoOfRequester[] = $rowForGettingInfoOfRequest;
				}
			}
		}

		echo json_encode(array_merge(array("request"=>$listOfRequests),array("requesterInfo"=>$infoOfRequester)));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>