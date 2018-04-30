<!DOCTYPE html>
<html lang="it">

<head>
	<?php 
		require 'config.php';
		include 'login.php';
	?>
	<script src="../js/login.js"></script>
	<title>Bongo</title>
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">
	<link href="../css/allpgs.css" rel="stylesheet" type="text/css">	
	<link href="../css/login.css" rel="stylesheet" type="text/css">

</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<nav class="main-nav">
				<h1 class="logo"><a href="../html/home.html">Bongo</a></h1>
				<ul class="main-nav-list">
					<li>
						<a href="../html/home.html">Home</a>
					</li>
					<li>
						<a onclick="document.getElementById('login-form-id').style.display='block'">Accedi</a>
					</li>
					<li>
						<a href="../html/signin.html">Registrati</a>
					</li>
					<li>
						<a href="../html/help.html">Aiuto</a>
					</li>
					<li>
						<a href="../html/about.html">Chi siamo</a>
					</li>
				</ul>
			</nav>
		</header>


		<section class="event-container">
			<?php 
			require 'connection.php';
			include 'query.php';
			include 'utility.php';

			//Creo un filtro per la query da eseguire
			$filter[] = new filter_value('idevent', 'd', $_GET['id'], '=');

			$filter_result = filter_query($filter);

			//Inizializzo
			$query		 = $filter_result[0];
			$bind_params = $filter_result[1];

			//Preparo il template dello statement sql
			$stmt = $conn->prepare($query);

			call_user_func_array(array($stmt, "bind_param"), ref_values($bind_params)); 
			//Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))

			//Eseguo la query
			$stmt->execute();

			//Ottengo i risultati della query
			$result = $stmt->get_result();


			if(!$result)
				echo "Errore nella query.";
			else {
				$row = $result->fetch_assoc();

				$id = $row[$idcol];
				$img = $row[$imgcol];
				$title = $row[$titlecol];
				$description = $row[$descol];

				echo "<img class=\"img-container\" src=\"{$img}\">";
				echo "<h1>{$title}</h1>";
				echo "<article>{$description}</article>";
			}

			?> 

			<img>
			<section class="event-description">
				<section class="">
					<h1>Titolo | Ore Data Luogo</h1>
					<article>Descrizione</article>
				</section>
				<aside>
					Partecipa
				</aside>
			</section>
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