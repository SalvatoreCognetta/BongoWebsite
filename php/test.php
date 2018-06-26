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
	<script src="../js/slideshow.js"></script>
	<script src="../js/test.js" defer></script>


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/profile.css" rel="stylesheet" type="text/css">

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




		<div class="actions">
		
			<span>Upload</span>
			<input type="file" id="upload" value="Choose a file" accept="image/*" onchange="readURL(this);" />
		
			<!-- Div contenente il toggle croppie con l'immagine inviata -->
			<div id="upload-demo" style="display: none"></div>

			<!-- Button che restituisce l'immagine ritagliata -->
			<button id="upload-result" class="upload-result" style="display:none" onclick="getResult()">Result</button>

			<!-- Div contentente il risultato dell'immagine dopo il ritaglio -->
			<div id="crop-img-container" style="display: none" class="modal-container animate">
				<span onclick="document.getElementById('crop-img-container').style.display='none'" class="close" title="Close Login">&times;</span>
				<div id="result-img" class="wrap-login"></div>
				<form method="post" id="form" action="./uploadtest.php">
					<input style="display:none" name="hidden" id="hidden">
					<input type="submit" value="ok">
				</form>
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