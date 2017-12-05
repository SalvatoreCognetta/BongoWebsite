<!DOCTYPE html>
<html lang="it">

<head>
	<title>Bongo</title>    
	<link href="../css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<header>
		<nav>
			<div class="nav-container">
				<h1>Bongo</h1>
				<ul>
					<li><a href="../html/home.html">Home</a></li>
					<li><a href="../html/login.html">Accedi</a></li>
					<li><a href="../html/signin.html">Registrati</a></li>
					<li><a href="../html/help.html">Aiuto</a></li>
					<li><a href="../html/about.html">Chi siamo</a></li>
				</ul>    
			</div>
		</nav>
	</header>

	<div class="filter-container">
		<aside>
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
        echo "id: " . $row["idevento"]. " - Name: " . $row["nomeEvento"]. " - Città:" . $row["citta"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?> 

</body>

</html>