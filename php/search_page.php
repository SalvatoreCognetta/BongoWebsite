<!DOCTYPE html>
<html lang="it">

<head>
	<?php 
	require 'config.php';
	require 'connection.php';
	//include 'login.php';
	?>
	<script src="../js/login.js"></script>	
	<title>Bongo</title>
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpgs.css" rel="stylesheet" type="text/css">	
	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">

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
						<a onclick="document.getElementById('login-container').style.display='block'">Accedi</a>
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

<div id="login-container" class="login-container" style="display:block;">
	<span onclick="document.getElementById('login-container').style.display='none'" class="close" title="Close Modal">&times;</span>
	
	<div class="wrap-login">
		<form class="login-form">
			<span class="login-form-logo">
				<img src="../img/icon/account_circle_black.svg">
			</span>

			<span class="login-form-title">
				Log in
			</span>

			<div class="wrap-input">
				<img src="../img/icon/face_black.svg" class="input-icon">
				<input class="login-input" type="text" name="username" placeholder="Username">
			</div>

			<div class="wrap-input">
				<img src="../img/icon/lock_black.svg" class="input-icon">
				<input class="login-input" type="password" name="pass" placeholder="Password">
			</div>

			<div class="remember-me">
				<input class="input-checkbox" id="ckbox" type="checkbox" name="remember-me">
				<label class="label-checkbox" for="ckbox">Remember me</label>
			</div>

			<div class="container-login-form-btn">
				<button class="login-form-btn">Login</button>
			</div>

			<a href=#>Forgot Password?</a>
		</form>
	</div>
</div>

		<section class="content">

			<aside class="side-filter">
				<form class="filter-form" action="search_page.php" method="get">
					<input type="text" name="title" placeholder="Filtra">
					<fieldset class="filter-form-item">
						<legend>Categoria eventi</legend>
						<input type="checkbox" name="category" value="test1">test
						<br/>
					</fieldset>
					<input type="date" name="date">
					<select name="city" required>
						<option value="" disabled selected>Città</option>
						<?php 
							$stmt = $conn->prepare("SELECT DISTINCT city FROM evento");							
							//Eseguo la query
							$stmt->execute();
							//Ottengo i risultati della query
							$result = $stmt->get_result();

							if(!$result)
								echo "Errore nella query.";
							else {
								while($row = $result->fetch_assoc()) {	
									$city = $row[$citycol];	
									echo "<option value=\"{$city}\">{$city}</option>";
								}
							}
						?>
					</select>
					<input type="submit" value="Cerca">
				</form>
			</aside>

			<!-- <nav class="filter-nav">
				<form action="search_page.php" method="get">
					<div class="filter-form">
						<input type="text" name="title" placeholder="Filtra">
						<select name="category">
							<option value="" disabled selected>Categoria</option>
							<option value="test1">test1</option>
							<option value="test2">test2</option>
						</select>
						<input type="date" name="date" >
						<select name="city">
							<option value="" disabled selected>Città</option>
							<option value="Pisa">Pisa</option>
						</select>						
						<input type="submit" value="Cerca">
					</div>
				</form>
			</nav> -->

			<?php
			include 'query.php';
			include 'utility.php';
			include 'card.php'; //oppure inserire la funzione di creazione card in utility.php?

			//Creo un array contenente i filtri inseriti dall'utente
			$filter_values	 = array();
			if(!empty($_GET['title']))
				$filter_values[] = new filter_value('title', 's', "%{$_GET['title']}%", 'LIKE');
			if(!empty($_GET['category']))				
				$filter_values[] = new filter_value('category', 's', $_GET['category'], '=');
			if(!empty($_GET['city']))				
				$filter_values[] = new filter_value('city', 's', $_GET['city'], '=');

			//Se l'utente ha inserito almeno un filtro allora aggiorno la pagina
			if(count($filter_values)) { 
				$filter_result = filter_query($filter_values);

				//Inizializzo
				$query		 = $filter_result[0];
				$bind_params = $filter_result[1];

				//Preparo il template dello statement sql
				$stmt = $conn->prepare($query);

				call_user_func_array(array($stmt, "bind_param"), ref_values($bind_params)); 
				//Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))
				/*In programmazione, un callback (o, in italiano, richiamo) è, in genere, una funzione, o un "blocco di codice" che viene passata come parametro ad un'altra funzione. In particolare, quando ci si riferisce alla callback richiamata da una funzione, la callback viene passata come argomento ad un parametro della funzione chiamante. In questo modo la chiamante può realizzare un compito specifico (quello svolto dalla callback) che non è, molto spesso, noto al momento della scrittura del codice. [Wikipedia]*/

				//Eseguo la query
				$stmt->execute();

				//Ottengo i risultati della query
				$result = $stmt->get_result();

				if(!$result)
					echo "Errore nella query.";

				else {
					echo "<section class=\"cards\">";
					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {						
							//Inizializzo tutti i valori necessari per creare la card con i risultati presi dal db
							$timestamp = strtotime($row[$datecol]);
							$date = date('d-m-Y', $timestamp);
							$time = date('H:i', $timestamp);

							$id = $row[$idcol];
							$img = $row[$imgcol];
							$title = $row[$titlecol];
							$description = $row[$descol];
							$price = $row[$pricecol];

							//Creo la card con la funzione presente in card.php
							create_event_card($id, $img, $title, $description, $date, $time, $price);
						}

					} else {
						create_error_card();
					}
					echo "</section>";
				}
			} else {
				echo "L'utente non ha inserito nessun filtro.";
			}

			$conn->close();
			?>


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