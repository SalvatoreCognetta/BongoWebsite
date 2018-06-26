<?php 
session_start();

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
require_once DIR_UTIL . 'sessionUtil.php'; 

if (!isLogged()){
	header('Location: ./index.php?error="Non sei loggato."');
	exit;
}	
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	<script src="../js/slideshow.js"></script>
	<script src="../js/test.js"></script>


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">
	<link href="../css/search_page.css" rel="stylesheet" type="text/css">

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
			include_once DIR_LAYOUT . 'card.php'; 	
			?>
				
		</header>

		<div class="content">
			<aside class="profile-side-menu">
				<ul>
					<li style="border-bottom: 1px solid grey;">Impostazioni Utente</li>
					<li><a href='./profile.php'>Profilo</a></li>
					<li><a href="#">Eventi in programma</a></li>
					<li><a href="./partecipated_events.php">Eventi a cui hai partecipato</a></li>
					<li>Eventi creati</li>
					<li><a href="./test.php">Test</a></li>
				</ul>
			</aside>
			<?php
			$events = get_future_events($_SESSION['userid']);
			echo "<section class=\"cards\">";
				if ($events->num_rows > 0) {
					while($row = $events->fetch_assoc()){
						//Inizializzo tutti i valori necessari per creare la card con i risultati presi dal db
						$timestamp = strtotime($row[$datecol]);
						$date = date('d-m-Y', $timestamp);
						$time = date('H:i', $timestamp);

						$id = $row[$idcol];
						$img = get_event_img_location($id);
						$title = $row[$titlecol];
						$description = $row[$descol];
						$price = $row[$pricecol];

						//Creo la card con la funzione presente in card.php
						create_event_card($id, $img, $title, $description, $date, $time, $price);
					
					}

				} 
			echo "</section>";
			?>
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