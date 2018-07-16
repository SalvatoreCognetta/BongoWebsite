<?php 
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	
	<script src="../js/comuni.js"></script>
	<script src="./test_ajax.js"></script>


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/create_event.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			include_once DIR_BASE . 'login_form.php';
			if(isLogged() === false) { ?>
				<script type="text/javascript">
					document.getElementById('login-container').style.display='block';				
				</script>
			<?php
			}
			?>
		</header>
		

		<div class="content">

			<h2>The form</h2>
			<form>
				<input type="text" name="name" id="city_input" list="cities_list">Name
				<datalist id="cities_list">
				</datalist>
				<br/>
				<input type="submit">
			</form>

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

	

