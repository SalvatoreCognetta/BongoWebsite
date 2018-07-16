<?php 
session_start();

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
require_once DIR_UTIL . 'sessionUtil.php'; 


?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	
	<script src="../js/test.js" async></script>


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">
	<link href="../css/croppie_wrapper.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


	<!-- Croppie tool for image picker -->
	<link rel="stylesheet" href="../css/croppie.css" />
	<script src="../js/croppie.js"></script>



</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			include DIR_BASE . 'login_form.php';

			?>

		</header>


		<!-- // <div class="col-1-2">
		// 	<div id="vanilla-demo"></div>
		// </div> -->
<div id="stripes" class="stripes">
	<span></span>
	<span></span>
</div>
<!-- <form action="./uploadtest.php"> -->
	Test
	<button id="btn" onclick="test()">Btn</button>
<!-- </form> -->

		<div class="upload-croppie">
			<label for="upload-img">Inserisci un'immagine per l'evento</label>
			
			<input type="file" id="upload-img" value="Choose a file" accept="image/*" onchange="readURL(this);" />

			<!-- Div contenente il toggle croppie con l'immagine inviata -->
			<div id="upload-croppie" style="display: none"></div>

			<!-- Button che restituisce l'immagine ritagliata -->
			<input type="button" id="btn-croppie-result" class="get-result" value="Risultato" style="display:none" onclick="getResult()">

			<!-- Div contentente il risultato dell'immagine dopo il ritaglio -->
			<div id="croppied-wrapper" class="grey-wrapper animate">
				<span onclick="document.getElementById('croppied-wrapper').style.display='none'" class="close" title="Close Modal">&times;</span>

				<div id="croppied-img-container" class="alert-container ">

					<div id="result-img" class="wrap-login"></div>
					<form method="post" id="form" action="#">
						<input style="display:none" name="hidden-img" id="hidden-img">
						<input type="button" value="ok" onclick="document.getElementById('croppied-wrapper').style.display='none'">
					</form>
				</div>
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