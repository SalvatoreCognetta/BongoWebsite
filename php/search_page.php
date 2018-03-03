<!DOCTYPE html>
<html lang="it">

<head>
	<title>Bongo</title>    
	<link href="../css/reset.css" rel="stylesheet" type="text/css">	
	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="content"> <!-- Necessario per lo sticky footer -->
		<header>
			<nav class="main-nav">
				<h1 class="logo">Bongo</h1>
				<ul class="nav-list-container">
					<li><a href="../html/home.html">Home</a></li>
					<li><a href="../html/login.html">Accedi</a></li>
					<li><a href="../html/signin.html">Registrati</a></li>
					<li><a href="../html/help.html">Aiuto</a></li>
					<li><a href="../html/about.html">Chi siamo</a></li>
				</ul>    
			</nav>
		</header>



		<div class="filter-container">
			<aside class="side">
				<label class="test-container"> One
					<input type="checkbox" checked="checked">
					<span class="checkmark"></span>
				</label>

				<form>
					<fieldset>
						<legend>Tipo di eventi</legend>
						<input type="checkbox" name="" id="">test<br/>
						
					</fieldset>
				</form>
				<h3>Tipo di eventi</h3>
				<ul>
				<li>test</li>
				</ul>
			</aside>

			<section class="cards">
				<article class="card">
					<img src="../img/img_fjords.jpg">
					<div class="card-info">
						<h2>Titolo</h2> 				
						<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
					</div>
					<div class="card-date">
						<h3>Data</h3>
						<p>22/01/2018</p>
						<h3>Ora</h3>
						<p>22:30</p>
						<h3>Prezzo</h3>
						<p>5€</p>
					</div>
				</article>
			</section>
			
		</div>


		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "eventi_bongo";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$sql = "SELECT * FROM evento";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				echo "id: " . $row["idevento"]. " - Name: " . $row["nomeEvento"]. " - Città: " . $row["citta"]. "<br>";
			}
		} else {
			echo "0 results";
		}

		mysqli_close($conn);
		?> 

	</div>

	<footer class="main-footer">
		<ul>
			<li><a href="">Termini &amp; Condizioni</a></li>
			<li><small>© copyright 2017 Example Corp.</small></li>
		</ul>
	</footer>


</body>

</html>