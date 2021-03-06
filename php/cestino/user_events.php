<?php 
session_start();

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
require_once DIR_UTIL . 'sessionUtil.php'; 

if (!isLogged()){
	header('Location: ./index.php?err="Non sei loggato."');
	exit;
}	
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	
	<script src="../js/test.js"></script>


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


	<!-- Croppie tool for image picker -->
	<!-- <link rel="stylesheet" href="croppie.css" />
	<script src="croppie.js"></script>

 -->

</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			?>
				
		</header>

		<div class="content">
			<aside class="profile-side-menu">
				<ul>
					<li>Impostazioni Utente</li>
					<li><a href='#'>Profilo</a></li>
					<li>Eventi seguiti</li>
					<li>Eventi creati</li>
					<li><a href="./test.php">Test</a></li>
				</ul>
			</aside>
			
		</div>

	</div>

	<footer class="main-footer">
		<ul>
			<li>
				 <a href="../html/help.html">Manuale utente</a>
			</li>
			<li>
				<small>  Copyright 2018 Cognetta Corp.</small>
			</li>
		</ul>
	</footer>


</body>

</html>