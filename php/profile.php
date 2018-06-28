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
	<script src="../js/slideshow.js"></script>
	<script src="../js/profile_img_croppie.js" defer></script>
	
	<!-- <script src="../js/test.js"></script> -->


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
			
			$location = get_avatar_location($_SESSION['userid']);
			$user_info = get_user_info($_SESSION['userid']);
			?>
				
		</header>

		<div class="content">
			<aside class="profile-side-menu">
				<ul>
					<li class="title-settings">Impostazioni Utente</li>
					<li class="is-over active"><a href='#'>Profilo</a></li>
					<li class="is-over"><a href="./followed_events.php">Eventi in programma</a></li>
					<li class="is-over"><a href="./partecipated_events.php">Eventi a cui hai partecipato</a></li>
					<li class="is-over"><a href="./created_events.php">Eventi creati</a></li>
					<li class="is-over"><a href="./test.php">Test</a></li>
				</ul>
			</aside>
			<div class="profile-settings">

				<div class="row">
					<div class="circular-img">
						<img class="profile-img" src="<?php echo $location;?>" alt="Avatar">
					</div>
					<div class="upload-croppie">
						<label for="upload-img">Modifica l'immagine del profilo</label>
						
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
								<form method="post" id="img-form" action="./upload.php">
									<input style="display:none" name="hidden-img" id="hidden-img">
									
									<div class="row">
										<button type="reset" class="croppie-btn cancel-btn" onclick="document.getElementById('croppied-wrapper').style.display='none'">Annulla</button>
										<button type="submit" class="croppie-btn" form="img-form" onclick="document.getElementById('croppied-wrapper').style.display='none'">Ok</button>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>

				<hr>

				<form method="POST" action="./update_profile.php" class="column profile-info">
					<h2>Impostazioni principali</h2>
					<label>Nickname</label>
					<input type="text" name="username" value="<?php echo $user_info['username'];?>" autocomplete="off">
				
					<label>Fullname</label>
					<input type="text" name="name" value="<?php echo $user_info['fullname']?>" autocomplete="off">
			
					<label>Email</label>
					<input type="text" name="email" value="<?php echo $user_info['email']?>" autocomplete="off">

					

					<button>Aggiorna</button>
				</form>

				<form method="post" action="./update_psw.php" class="column profile-info">
					<label>Password</label>
					<input type="password" name="old-psw" placeholder="Vecchia password" required>
					<input type="password" name="new-psw" placeholder="Nuova password" required>
					<button>Aggiorna</button>
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