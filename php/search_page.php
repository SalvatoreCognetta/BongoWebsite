<!DOCTYPE html>
<html lang="it">

<head>
	<?php require 'config.php'?>
	<title>Bongo</title>
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="wrapper"> 	<!-- Necessario per lo sticky footer -->
		<header>
			<nav class="main-nav">
				<h1 class="logo">Bongo</h1>
				<ul class="main-nav-list">
					<li>
						<a href="../html/home.html">Home</a>
					</li>
					<li>
						<a onclick="document.getElementById('id01').style.display='block'">Accedi</a>
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

		<script>
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {//27 is the code for escape
					document.getElementById("id01").style.display = 'none'; 
				}
			};
		</script>


		<!-- The Modal -->
		<div id="id01" class="modal">
			<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

			<!-- Modal Content -->
			<form class="modal-content animate" action="/action_page.php">
				<div class="imgcontainer">
				<!-- <img src="../img/bar.jpeg" alt="Avatar" class="avatar"> -->
				</div>

				<div class="container">
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>

				<button type="submit">Login</button>
				<label>
					<input type="checkbox" checked="checked" name="remember"> Remember me
				</label>
				</div>

				<div class="container" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				<span class="psw">Forgot <a href="#">password?</a></span>
				</div>
			</form>
		</div> 

		<!-- <form name="login-form" action="action_page.php">
			<div class="imgcontainer">
				<img src="img_avatar2.png" alt="Avatar" class="avatar">
			</div>

			<div class="login-container">
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>

				<button type="submit">Login</button>
				<label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
				</label>
			</div>

			<div class="login-container" style="background-color:#f1f1f1">
				<button type="button" class="cancelbtn">Cancel</button>
				<span class="psw">Forgot <a href="#">password?</a></span>
			</div>
		</form>  -->
		
		<!-- <section class="cards">
			<article class="card">
				<img src="../img/img_fjords.jpg">
				<div class="card-info">
					<h2>Titolo</h2> 				
					<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
				</div>
				<div class="card-date">
					<div class="card-date-info">
						<h3>Data: </h3>
						<p>22/01/2018</p>
					</div>
					
					<div class="card-date-info">
						<h3>Ora: </h3>
						<p>22:30</p>
					</div>

					<div class="card-date-info">
						<h3>Prezzo: </h3>
						<p>5€</p>
					</div>
					
					<button class="card-button">></button>
				</div>
			</article>
		</section> -->


		<section class="content">

			<aside class="side-filter">
				<form class="filter-form" action="search_page.php" method="get">
					<input type="text" name="title" placeholder="Filtra">
					<fieldset class="filter-form-item">
						<legend>Categoria eventi</legend>
						<input type="checkbox" name="category" value="test1">test<br/>
					</fieldset>
					<input type="date" name="date">
					<select name="city" required>
						<option value="" disabled selected>Città</option>
						<option value="Pisa">Pisa</option>
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
			require 'connection.php';
			include 'query.php';
			include 'utility.php';
			include 'card.php'; //oppure inserire la funzione di creazione card in utility.php?


			$values = array_filter($_GET);

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


				echo "<section class=\"cards\">";
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {						
						//Inizializzo tutti i valori necessari per creare la card con i risultati presi dal db
						$timestamp = strtotime($row["date"]);
						$date = date('d-m-Y', $timestamp);
						$time = date('H:i', $timestamp);

						$img = $row["img"];
						$title = $row["title"];
						$description = $row["description"];
						$price = $row["price"];

						//Creo la card con la funzione presente in card.php
						create_event_card($img, $title, $description, $date, $time, $price);
					}

				} else {
					create_error_card();
				}
				echo "</section>";

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