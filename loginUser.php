<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require 'database.php';
	loginUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function loginUser(){
	global $con;

	$emailAddress = $_POST['emailAddress'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query=mysqli_query($con,"SELECT * FROM tblusers WHERE EmailAddress='$emailAddress' OR Username='$username' AND Password='$password'");
  	$numrows=mysqli_num_rows($query);

  	if($numrows!=0){
    	while($row=mysqli_fetch_assoc($query)){
      		$dbEmailAddress=$row['EmailAddress'];
      		$dbUsername=$row['Username'];
      		$dbPassword=$row['Password'];
      		$dbUserType=$row['UserType'];
    	}

	  	if($emailAddress == $dbEmailAddress || $username == $dbUsername && $password == $dbPassword){
	    	if($dbUserType == "Council"){
	    		echo "success_council";
	    	}else{
	    		echo "success_resident";
	    	}
	   	}
  	}else{
  		echo "invalid";
  	}

	mysqli_close($con);
}

?>