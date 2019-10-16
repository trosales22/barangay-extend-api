<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	addFeedback();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addFeedback(){
	global $con;

	$feedback = $_POST['feedback'];
	$feedbackType = $_POST['feedbackType'];
	$submittedBy = $_POST['$submittedBy'];
	$dateAndTimeSubmitted = $_POST['dateAndTimeSubmitted'];

	$query = "INSERT INTO tblfeedback(Feedback,FeedbackType,SubmittedBy,DateAndTimeSubmitted) VALUES (?,?,?,?)";

	$stmt = mysqli_prepare($con,$query);

	mysqli_stmt_bind_param($stmt,"ssss",$feedback,$feedbackType,$submittedBy,$dateAndTimeSubmitted);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check == 1){
		echo "Thankyou for your feedback.";
	}else{
		echo "Failed to add feedback. Please try again!";
	}

	mysqli_stmt_close($stmt); 

	mysqli_close($con);
}

?>