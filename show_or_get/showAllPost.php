<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllPost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllPost(){
	global $con;

	$query="SELECT * FROM tblposts ORDER BY ID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfPosts = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfPosts[$row['ID']] = [
				'ID' => $row['ID'],
				'TopicTitle' => $row['TopicTitle'],
				'TopicDescription' => $row['TopicDescription'],
				'TopicLocationID' => $row['TopicLocationID'],
				'TopicImage' => $row['TopicImage'],
				'TopicLocationName' => $row['TopicLocationName'],
				'TopicLocationAddress' => $row['TopicLocationAddress'],
				'TopicType' => $row['TopicType'],
				'TopicPostedBy' => $row['TopicPostedBy'],
				'TopicPosterBarangay' => $row['TopicPosterBarangay'],
				'TopicDateAndTimePosted' => $row['TopicDateAndTimePosted'],
				'posterInfo' => []
			];

			$topicID = $row['ID'];
			$userID = $row['TopicPostedBy'];

			$queryForGettingInfoOfPoster="SELECT Firstname,Lastname,ProfilePicture,UserType,Barangay FROM tblusers WHERE HEX(UserID)='$userID'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfPosts[$topicID]['posterInfo'][] = [
						'Firstname' => $rowForGettingInfoOfPoster['Firstname'],
						'Lastname' => $rowForGettingInfoOfPoster['Lastname'],
						'ProfilePicture' => $rowForGettingInfoOfPoster['ProfilePicture'],
						'UserType' => $rowForGettingInfoOfPoster['UserType'],
						'Barangay' => $rowForGettingInfoOfPoster['Barangay']
					];
				}
			}
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfPosts as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("posts"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>