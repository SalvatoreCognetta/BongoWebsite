<!DOCTYPE html>
<html lang="it">

<head>
	<?php 
	require 'config.php';
	require 'connection.php';
	include 'query.php';
	include 'login.php';

	session_start();
	if(empty($_SESSION)) {	
		$_SESSION['loggedin'] = false;	
	}
	
	if(isset($_POST["username"]) && isset($_POST["pass"])) {
		if(check_user($_POST["username"], $_POST["pass"], $conn)) {
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
		}	
	}
	
	?>

	<script src="../js/login.js"></script>	
	
    <title>Bongo</title>
    <link href="../css/home.css" rel="stylesheet" type="text/css">
	
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">	
	<link href="../css/login.css" rel="stylesheet" type="text/css">	


	
</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<?php include 'header.php'; ?>


<div id="map" style="width:400px;height:400px;background:yellow"></div>

<script>
function myMap() {
var mapOptions = {
    center: new google.maps.LatLng(51.5, -0.12),
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.HYBRID
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
	</div>

<footer class="main-footer">
	<ul>
		<li>
			<a href="">Termini &amp; Condizioni</a>
		</li>
		<li>
			<small>© copyright 2017 Example Corp.</small>
		</li>
	</ul>
</footer>


</body>
</html>