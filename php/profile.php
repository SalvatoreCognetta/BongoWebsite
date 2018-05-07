<?php 
	require 'config.php';
	require 'connection.php';
	include 'query.php';
	include 'login.php';

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
			<?php include 'nav_bar.php'; ?>
		</header>

		<section class="content">

			<form action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="file" name="file" />
				<button type="submit" name="btn-upload">upload</button>
			</form>
		</section>

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