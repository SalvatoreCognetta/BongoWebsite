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

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


	<!-- Croppie tool for image picker -->
	<link rel="stylesheet" href="croppie.css" />
	<script src="croppie.js"></script>



</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			?>
				
		</header>
<script>
	console.log("Test.");
	var vanilla = new Croppie(document.getElementById('profile-img'), {
		viewport: { width: 100, height: 100 },
		boundary: { width: 300, height: 300 },
		showZoomer: false,
		enableOrientation: true
	});
	// call a method
	vanilla.bind({
		url: '../img/upload/sardegna\ la\ pelosa1.jpg',
		orientation: 4
	});
	//on button click
	vanilla.result('blob').then(function(blob) {
		// do something with cropped blob
});
</script>
		<div class="content">
			<div class="row">
				<img id="profile-img" class="profile-img" src="<?php echo $location;?>" alt="Immagine non presente nel database.">
				<form class="upload-img" action="./upload.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="file" accept="image/png, image/jpeg"/>
					<button type="submit" name="btn-upload">Upload</button>
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