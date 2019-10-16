<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	getAllAvailableSecurityQuestions();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function getAllAvailableSecurityQuestions(){
	global $con;

	$query="SELECT Question FROM tblquestions";
	$result = mysqli_query($con,$query);

	$numrows=mysqli_num_rows($result);

	$listOfSecurityQuestions = array();

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($result)){
			$listOfSecurityQuestions[] = $row;
		}

		header('Content-Type: application/json');
		echo json_encode(array("securityQuestions"=>$listOfSecurityQuestions));
	}else{
		echo "No record found!";
	}

	mysqli_close($con);
}

?>