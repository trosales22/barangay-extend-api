<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	require '../database.php';
	addBarangay();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function addBarangay(){
	global $con;
	global $barangayExtendUrl;

	$barangayName = $_POST['barangayName'];
	$barangayDescription = $_POST['barangayDescription'];
	$barangayLogo = base64_decode($_POST['barangayLogo']);
	$dateAndTimeAdded = $_POST['dateAndTimeAdded'];

	$sql ="SELECT BarangayID FROM tblbarangay ORDER BY BarangayID ASC";

	$res = mysqli_query($con,$sql);
	 
	$id = 0;
	 
	while($row = mysqli_fetch_array($res)){
	 	$id = $row['BarangayID'];
	}

	$path = "../images/barangay_logo/$id.jpg";

	$actualPath = $barangayExtendUrl . "images/barangay_logo/$id.jpg";

	$file = fopen($path, 'wb');

	$isWritten = fwrite($file, $barangayLogo);
	fclose($file);

	if($isWritten > 0){
		$queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tblbarangay WHERE BarangayName='$barangayName'");
    	$numrows=mysqli_num_rows($queryToDetectIfExisting);

	    if($numrows==0){
			$query = "INSERT INTO tblbarangay(BarangayName,BarangayDescription,BarangayLogo,DateAndTimeAdded) VALUES (?,?,?,?)";

			$stmt = mysqli_prepare($con,$query);

			mysqli_stmt_bind_param($stmt,"ssss",$barangayName,$barangayDescription,$actualPath,$dateAndTimeAdded);

			mysqli_stmt_execute($stmt);

			$check = mysqli_stmt_affected_rows($stmt);

			if($check == 1){
				echo "Barangay has been successfully added to the database!";
			}else{
				echo "Failed to add barangay!";
			}

			mysqli_stmt_close($stmt); 
	    }else{
	    	echo "Barangay already exists. Please try another!";
	    }

		mysqli_close($con);
	}
}

?>