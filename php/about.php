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
	<script src="../js/login.js"></script>
	<script src="../js/utility.js"></script>	

	

	<script src="../js/comuni.js"></script>
	<script src="../js/get_hint.js" defer></script>



	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">

	<link href="../css/about.css" rel="stylesheet" type="text/css">

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

		<div id="stripes" class="stripes">
			<span></span>
			<span></span>
			<!-- <span></span> --> 
		</div>


		<div class="wrapper">
			<div class="container">
				test
			</div>
		</div>

	</div>

	<footer class="main-footer">
		<ul>
			<li>
				 <a href="../html/help.html">Manuale utente</a>
			</li>
			<li>
				<small>  copyright 2018 Example Corp.</small>
			</li>
		</ul>
	</footer>


</body>

</html>