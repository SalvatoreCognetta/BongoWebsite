<?php 
session_start();

require __DIR__ . '/config.php';
require DIR_UTIL . 'dbConfig.php';
require DIR_UTIL . 'dbConfig.php';

include 'query.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>	
	<script src="../js/test.js"></script>	
	
	<title>Bongo</title>
	<link href="../css/search_page.css" rel="stylesheet" type="text/css">	
	
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
		include DIR_BASE . 'nav_bar.php'; 
		include DIR_BASE . 'login_form.php';		 	
		?>
		</header>

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
			include DIR_UTIL . 'utility.php';
			include DIR_LAYOUT . 'card.php';  
			
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
			} else { //Qui non dovrebbe mai arrivare!
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