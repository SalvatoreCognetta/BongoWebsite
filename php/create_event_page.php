<?php 
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
require_once DIR_UTIL . 'sessionUtil.php';

if(isLogged() === false) {
	//Mostrare un errore nella pagina index 
	$err = "Devi essere loggato per creare un nuovo evento.";
	header("Location: ./index.php?err=" . $err);
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	
	<script src="../js/comuni.js"></script>
	<script src="../js/get_hint.js" defer></script>
	<script src="../js/create_event.js" defer></script>
	
	<script src="../js/utility.js" ></script>



	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/create_event.css" rel="stylesheet" type="text/css">
	<link href="../css/croppie_wrapper.css" rel="stylesheet" type="text/css">


	<!-- Croppie tool for image picker -->
	<link rel="stylesheet" href="../css/croppie.css" />
	<script src="../js/croppie.js"></script>


</head>

<body onload="initDate();">
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			include_once DIR_BASE . 'login_form.php';
			if(!empty($_GET['err'])) {
				$message = $_GET['err'];
				echo "<script>alert(\"".$message."\");</script>";
				
			}

			?>
		</header>

		<div id="stripes" class="stripes">
			<span></span>
			<span></span>
			<!-- <span></span> --> 
		</div>
		

		<div class="content">



			<h1>Crea il tuo nuovo evento</h1>
		
			<form class="creation-form" method="post" action="create_event.php"  onsubmit="return checkCreateEvent()" enctype="multipart/form-data">
				<div class="column">
					<div class="flex">
						<div class="column" style="margin-right: 100px;">
							<label for="name">Titolo evento</label>
							<input id="name" class="form-input" name="title" type="text" placeholder="Nome evento" required>

							<label for="city_input">Localit&agrave;</label>
							<form>
								<input type="text" name="city" id="city_input" class="form-input" list="cities_list" placeholder="Luogo" autocomplete="off" required>
								<datalist id="cities_list">
								</datalist>
								<br/>
							</form>

							
							<label for="date-input">Quando si terr&agrave; l'evento?</label><br>
							<input id="date-input" class="form-input" type="date" name="date" required>
							<input class="form-input" type="time" value="13:30" name="time" required>
						</div>
						
						<!-- <input id="img" type="file" name="file" accept="image/png, image/jpeg"/> -->
						
						<div class="upload-croppie">
							<label>Inserisci un'immagine per l'evento</label>
			
							
							<!-- Div contenente il toggle croppie con l'immagine inviata -->
							<div id="upload-croppie" style="display: none"></div>
						
							<div class="flex">
								<!-- In questo modo elimino il testo del file selezionato -->
								<input type="file" id="upload-img" style="display: none;" accept="image/*" onchange="readURL(this);"  />						
								<input id="file-choice" type="button" value="Scegli un file" class="btn btn-wide" onclick="document.getElementById('upload-img').click();" />
								
								<!-- Button che restituisce l'immagine ritagliata -->
								<input type="button" id="btn-croppie-result" class="btn btn-wide" value="Anteprima" style="display:none" onclick="getResult()">
							</div>
							<!-- Div contentente il risultato dell'immagine dopo il ritaglio -->
							<div id="croppied-wrapper" class="grey-wrapper animate">
								<span onclick="document.getElementById('ok-btn').click();" class="close" title="Close Modal">&times;</span>
							
								<div id="croppied-img-container"  class="alert-container ">
									<div id="result-img" class="wrap-result"></div>
									<input style="display:none" name="hidden-img" id="hidden-img">
								
										<input id="ok-btn" class="croppie-btn" type="button" value="Ok" onclick="document.getElementById('croppied-wrapper').style.display='none'">
								</div>
							</div>
							
						</div>
					</div>
			


					<label for="description">Descrivi il tuo evento</label>
					<textarea class="form-input" name="description" id="description" rows="7" placeholder="Descrizione" minlength="50" maxlength="2000" required></textarea>

					<div class="column">
						<label>Tipo di evento</label>
						<select id="categories" name="categories" required>
							<option value="" disabled selected>Seleziona una categoria</option>

							<?php 
								$categories = get_categories();
								for($i = 0; $i < count($categories); $i++) {
									echo "<option value=".$categories[$i].">" . $categories[$i] . "</option>";
								}
							?>
						</select>
					</div>
					
					<h2 >Il biglietto sar&agrave gratuito o a pagamento?</h2>
					<div id="radioChoices" class="radio-choice">
						<input type="radio" id="radioChoice1" name="price-choice" onclick="hide('wrapper-price-input');" value="free">
						<label for="radioChoice1">Gratuito</label><br>
					
						<input type="radio" id="radioChoice2" name="price-choice" onclick="show('wrapper-price-input');" value="pay">
						<label for="radioChoice2">A pagamento</label><br>
						

					</div>
					<div class="wrapper-price-input" id="wrapper-price-input">
						<label for="price-input">Inserisci il prezzo del biglietto:</label>
						<input id="price-input" class="form-input" type="number" min="0.50" max="100.00" step="0.1" value="5.0" name="ticket-price">
						<span>&euro;</span>
					</div>
				
					<button id="btn-submit" type="submit" class="btn">Crea evento</button>


				</div>

			</form>

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



