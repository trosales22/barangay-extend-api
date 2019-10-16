<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	insertUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function insertUser(){
	global $con;

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$emailAddress = $_POST['emailAddress'];
	$username = $_POST['username'];
	$phoneNumber = $_POST['phoneNumber'];
	$gender = $_POST['gender'];
	$userType = $_POST['userType'];
	$userStatus = $_POST['userStatus'];
	$barangay = $_POST['barangay'];
	$password = $_POST['password'];
	$securityQuestion = $_POST['securityQuestion'];
	$securityQuestion_answer = $_POST['securityQuestion_answer'];
	$dateAndTimeRegistered = $_POST['dateAndTimeRegistered'];

	$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblusers WHERE EmailAddress='$emailAddress'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);

    if($numrows==0){
		$query = "INSERT INTO tblusers(UserID,Firstname,Lastname,EmailAddress,Username,PhoneNumber,Gender,UserType,UserStatus,Barangay,Password,SecretQuestion,SecretAnswer,DateAndTimeRegistered) 
		VALUES (unhex(replace(uuid(),'-','')),?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"sssssssssssss",$firstname,$lastname,$emailAddress,$username,$phoneNumber,$gender,$userType,$userStatus,$barangay,$password,$securityQuestion,$securityQuestion_answer,$dateAndTimeRegistered);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Your account has been successfully created!";
		}else{
			echo "Failed to create your account!";
		}

		mysqli_stmt_close($stmt); 
    }else{
    	echo "Email Address already exists. Please try another!";
    }

	mysqli_close($con);
}

?>