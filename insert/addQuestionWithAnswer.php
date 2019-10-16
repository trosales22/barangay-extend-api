<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	addQuestionWithAnswer();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addQuestionWithAnswer(){
	global $con;

	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$dateAndTimeAdded = $_POST['dateAndTimeAdded'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblfaq WHERE Question='$question'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblfaq(Question,Answer,DateAndTimeAdded) VALUES (?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"sss",$question,$answer,$dateAndTimeAdded);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Question for FAQ has been successfully added to the database!";
		}else{
			echo "Failed to add question in FAQ!";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "Question for FAQ already exists. Please try another!";
    }

	mysqli_close($con);
}

?>