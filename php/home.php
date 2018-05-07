<!DOCTYPE html>
<html lang="it">

<head>
	<?php 
	require 'config.php';
	require 'connection.php';
	include 'query.php';

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
	<script src="../js/slideshow.js"></script>
	<script src="../js/test.js"></script>	

	
    <title>Bongo</title>
    <link href="../css/home.css" rel="stylesheet" type="text/css">
	
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">	
	<link href="../css/login.css" rel="stylesheet" type="text/css">	

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">		
	
	
</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
				include 'nav_bar.php'; 	
				include 'login.php';
			?>
		</header>


		<div class="wrap-container">
			<div class="container">
				<h1>Cosa fare stasera?</h1>
				<h2>Cerca gli eventi nella tua zona.</h2>

				<form action="../php/search_page.php">
					<input type="text" name="city" placeholder="Inserisci una citt&agrave;">
					<input type="submit" value="Cerca">
				</form>

				<a href="./map.php">Mappa Test</a>
			</div>
		</div>
	
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