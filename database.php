<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','dbbarangayextend');
 
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die ("could not connect to mysql");
$barangayExtendUrl = "http://tristanrosales.x10.mx/Barangay%20Extend/";
?>