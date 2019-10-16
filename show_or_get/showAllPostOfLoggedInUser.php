<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllPostOfLoggedInUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllPostOfLoggedInUser(){
	global $con;

	$userLoggedInID = $_GET['userID'];

	$query="SELECT * FROM tblposts WHERE TopicPostedBy='$userLoggedInID'";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfPosts = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$userID = $row['TopicPostedBy'];
			$listOfPosts[] = $row;

			$queryForGettingInfoOfPoster="SELECT Firstname,Lastname,ProfilePicture,UserType,Barangay FROM tblusers WHERE HEX(UserID)='$userID'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			$infoOfPoster = array();

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$infoOfPoster[] = $rowForGettingInfoOfPoster;
				}
			}
		}

		echo json_encode(array_merge(array("posts"=>$listOfPosts),array("posterInfo"=>$infoOfPoster)));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>