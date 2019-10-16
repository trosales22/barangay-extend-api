<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	addQuestionInRegistration();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addQuestionInRegistration(){
	global $con;

	$question = $_POST['question'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblquestions WHERE Question='$question'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblquestions(Question) VALUES (?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"s",$question);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Question in registration has been successfully added to the database!";
		}else{
			echo "Failed to add question in registration!";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "Question in registration already exists. Please try another!";
    }

	mysqli_close($con);
}

?>