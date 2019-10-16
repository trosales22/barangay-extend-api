<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	postSomething();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function postSomething(){
	global $con;
	global $barangayExtendUrl;

	$topicTitle = $_POST['topicTitle'];
	$topicDescription = $_POST['topicDescription'];
	$topicImage = base64_decode($_POST['topicImage']);
	$topicLocationID = $_POST['topicLocationID'];
	$topicLocationName = $_POST['topicLocationName'];
	$topicLocationAddress = $_POST['topicLocationAddress'];
	$topicType = $_POST['topicType'];
	$topicPostedBy = $_POST['topicPostedBy'];
	$topicPosterBarangay = $_POST['topicPosterBarangay'];
	$topicDateAndTimePosted = $_POST['topicDateAndTimePosted'];

	$sql ="SELECT ID FROM tblposts ORDER BY ID ASC";
 
	$res = mysqli_query($con,$sql);
	 
	$id = 0;
	 
	while($row = mysqli_fetch_array($res)){
	 	$id = $row['ID'];
	}

	$path = "../images/posts/$id.jpg";

	$actualPath = $barangayExtendUrl . "images/posts/$id.jpg";

	$file = fopen($path, 'wb');

	$isWritten = fwrite($file, $topicImage);
	fclose($file);

	if($isWritten > 0){
		$query = "INSERT INTO tblposts(TopicTitle,TopicDescription,TopicImage,TopicLocationID,TopicLocationName,TopicLocationAddress,TopicType,TopicPostedBy,TopicPosterBarangay,TopicDateAndTimePosted) 
		VALUES (?,?,?,?,?,?,?,?,?,?)";

		$stmt = mysqli_prepare($con,$query);

		mysqli_stmt_bind_param($stmt,"ssssssssss",$topicTitle,$topicDescription,$actualPath,$topicLocationID,$topicLocationName,$topicLocationAddress,$topicType,$topicPostedBy,$topicPosterBarangay,$topicDateAndTimePosted);

		mysqli_stmt_execute($stmt);

		$check = mysqli_stmt_affected_rows($stmt);

		if($check == 1){
			echo "Topic posted successfully!";
		}else{
			echo "Failed to post your topic!";
		}
		mysqli_stmt_close($stmt); 
		mysqli_close($con);
	}
}

?>