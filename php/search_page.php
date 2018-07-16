<?php 
session_start();

require __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js" defer></script>	
	<script src="../js/utility.js"></script>	
	
	<script src="../js/check_date.js" defer></script>	

	<script src="../js/comuni.js"></script>
	<script src="../js/get_hint.js" defer></script>

	
	<title>Bongo</title>
	<link href="../css/search_page.css" rel="stylesheet" type="text/css">	
	
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">	
	<link href="../css/login.css" rel="stylesheet" type="text/css">	
	

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

		<div id="stripes" class="stripes">
			<span></span>
			 <span></span>
			<!-- <span></span> --> 
		</div>

		<div class="content">

			<aside class="side-filter">
				<form class="filter-form" action="search_page.php" onsubmit="return checkSearch();" method="get">
					<input id="title" class="form-input" type="text" name="title" placeholder="Filtra">
				
					<label>Categoria eventi</label>
					<fieldset id="categories" class="filter-form-item">
						
						<?php
						$categories = get_categories();
						for($i = 0; $i < count($categories); $i++) {

							echo "<input id='checkbox" . $i . "' type='checkbox' name='category' value=".$categories[$i].">";
							echo "<label for='checkbox" . $i . "'>" . $categories[$i] . "</label>";
							
							echo "<br>";
						}
						?>
					</fieldset>
					<input id="date-input" class="form-input" type="date" name="date">
					<input class="form-input" type="time" name="time" value="21:00">
					
					<input type="text" style="display: none" name="city" value="<?php echo $_GET['city']; ?>">
					<input class="btn" type="submit" value="Cerca">
				</form>
			</aside>

			
			<?php
			include_once DIR_UTIL . 'utility.php';
			include DIR_LAYOUT . 'card.php';  
			
			//Creo un array contenente i filtri inseriti dall'utente
			$filter_values	= get_filter();
			

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
			} else { //Qui non dovrebbe mai arrivare
				echo "L'utente non ha inserito nessun filtro.";
			}

			?>


		</div>
	</div>

	<footer class="main-footer">
		<ul>
			<li>
				 <a href="../html/help.html">Manuale utente</a>
			</li>
			<li>
				<small>  copyright 2018 Example Corp.</small>
			</li>
		</ul>
	</footer>


</body>

</html>