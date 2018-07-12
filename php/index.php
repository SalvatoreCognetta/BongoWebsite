<?php 
	session_start();
	require_once __DIR__ . '/config.php';
	require_once DIR_UTIL . 'dbManager.php';
	require_once DIR_UTIL . 'query.php';
	include_once DIR_UTIL . 'sessionUtil.php';	
?>
<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js" defer></script>
	<script src="../js/slideshow.js"></script>	
	<script src="../js/comuni.js"></script>
	<script src="../js/get_hint.js" defer></script>
	

	
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
			include DIR_BASE . 'nav_bar.php'; 	
			include DIR_BASE . 'login_form.php';

			if(!empty($_GET['err'])) {
				$message = $_GET['err'];
				echo "<script>alert('$message');</script>";
				
			}
			?>
		</header>

		<div class="wrap-container">
			<div class="container">
				<h1>Cosa fare stasera?</h1>
				<h2>Cerca gli eventi nella tua citt&agrave;.</h2>

				<!-- <form action="./search_page.php">
					<input type="text" name="city" placeholder="Inserisci una citt&agrave;">
					<input type="submit" value="Cerca">
				</form> -->

				<form action="./search_page.php">
					<input class="form-input" type="text" name="city" id="city_input" list="cities_list" placeholder="Inserisci una citt&agrave;" autocomplete="off" required>
					<datalist id="cities_list">
					</datalist>
					<input class="btn btn-search" type="submit" value="Cerca">					
				</form>

				<!-- <a href="./map.php">Mappa Test</a> -->
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