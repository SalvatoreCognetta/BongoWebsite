<?php 
session_start();

require __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
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
						<option value="" disabled selected>Citt&agrave;</option>
						<?php 
							$query = "SELECT DISTINCT city FROM evento";
							$result = $bongoDb->performQuery($query); 
							
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

			
			<?php
			include_once DIR_UTIL . 'utility.php';
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
				$result = filter_query($filter_values);

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
							$img = get_event_img_location($id);
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