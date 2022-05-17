
<?php
	$host	 = "localhost";
	$user	 = "root";
	$pass	 = "";
	$dabname = "gpsdata";
	
	$conn = mysqli_connect('localhost', 'root', '') or die('Could not connect to mysqli server.' );
	mysqli_select_db($conn, 'gpsdata') or die('Could not select database.');
	$baseurl="http://localhost/angkasapura/";
?>