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
					<li style="border-bottom: 1px solid grey;">Impostazioni Utente</li>
					<li><a href='#'>Profilo</a></li>
					<li>Eventi seguiti</li>
					<li>Eventi creati</li>
					<li><a href="./test.php">Test</a></li>
				</ul>
			</aside>
			<div class="profile-settings">
				<?php 				
				global $bongoDb;
				$location = get_location($_SESSION['userid']);
				?>
				<div class="row">
					<div class="circular-img">
						<img class="profile-img" src="<?php echo $location;?>" alt="Immagine non presente nel database.">
					</div>
					<form class="upload-img" action="./upload.php" method="POST" enctype="multipart/form-data">
						<input type="file" name="file" accept="image/png, image/jpeg"/>
						<button type="submit" name="btn-upload">Upload</button>
					</form>
				</div>
				<hr>
				<div>
					<h2>Impostazioni principali</h2>
					<label>Nickname</label>
					<input type="text" name="name"/ value="<?php echo $_SESSION['username'];?>">
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