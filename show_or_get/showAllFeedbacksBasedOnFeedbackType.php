<?php
header('Content-Type: application/json; charset=utf-8');

if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	showAllFeedbacksBasedOnFeedbackType();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function showAllFeedbacksBasedOnFeedbackType(){
	global $con;

	$feedbackType = $_GET['feedbackType'];

	$query="SELECT * FROM tblfeedback WHERE FeedbackType='$feedbackType' ORDER BY ID DESC";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfFeedbacks = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfFeedbacks[$row['ID']] = [
				'ID' => $row['ID'],
				'Feedback' => $row['Feedback'],
				'FeedbackType' => $row['FeedbackType'],
				'SubmittedBy' => $row['SubmittedBy'],
				'DateAndTimeSubmitted' => $row['DateAndTimeSubmitted'],
				'feedbackByInfo' => []
			];

			$feedbackID = $row['ID'];
			$userID = $row['SubmittedBy'];

			$queryForGettingInfoOfPoster="SELECT Firstname,Lastname,ProfilePicture FROM tblusers WHERE HEX(UserID)='$userID'";

			$resultForGettingInfoOfPoster = mysqli_query($con,$queryForGettingInfoOfPoster);

			$numrowsForGettingInfoOfPoster=mysqli_num_rows($resultForGettingInfoOfPoster);

			if($numrowsForGettingInfoOfPoster > 0){
				while($rowForGettingInfoOfPoster = mysqli_fetch_assoc($resultForGettingInfoOfPoster)){
					$listOfFeedbacks[$feedbackID]['feedbackByInfo'][] = [
						'Firstname' => $rowForGettingInfoOfPoster['Firstname'],
						'Lastname' => $rowForGettingInfoOfPoster['Lastname'],
						'ProfilePicture' => $rowForGettingInfoOfPoster['ProfilePicture']
					];
				}
			}
		}

		// We want the final result to ignore the keys and to create a JSON array not a JSON object 
		$data = [];
		foreach ($listOfFeedbacks as $element) {
		    $data[] = $element;
		}
		
		echo json_encode(array("feedbacks"=>$data));
	}else{
		echo "no_data";
	}

	mysqli_close($con);
}

?>