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

<!DOCTYPE html>
<html lang="it">

<head>
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

		<div class="content">
			<aside class="profile-side-menu">
				<ul>
					<li style="border-bottom: 1px solid grey;">Impostazioni Utente</li>
					<li><a href='#'>Profilo</a></li>
					<li>Eventi seguiti</li>
					<li>Eventi creati</li>
				</ul>
			</aside>
			<div class="profile-settings">
				<?php 
				$query = "SELECT location FROM upload INNER JOIN user";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$result = $stmt->get_result();
				if(!$row = $result->fetch_assoc())
					echo "Errore durante l'upload della foto nel database.";
				?>
				<img class="profile-img" src="<?php echo $row['location'];?>">
				<form class="upload-img" action="upload.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="file" />
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