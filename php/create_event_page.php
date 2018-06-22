<?php 
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	<script src="../js/slideshow.js"></script>
	<script src="../js/get_hint.js"></script>
	


	<title>Bongo</title>

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/create_event.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'nav_bar.php';   	
			include_once DIR_BASE . 'login_form.php';
			if(isLogged() === false) { ?>
				<script type="text/javascript">
					document.getElementById('login-container').style.display='block';				
				</script>
			<?php
			}
			?>
		</header>
		

		<div class="content">



			<h1>Crea il tuo nuovo evento</h1>
		
			<form class="creation-form" method="post" action="create_event.php" enctype="multipart/form-data">
				<div class="tab">
					<label for="name">Titolo evento</label>
					<input id="name" name="title" type="text" placeholder="Nome evento" required>

					<label for="city">Localit&agrave;</label>
					<form>
						<input type="text" name="name" id="name_input" list="huge_list">
						<datalist id="huge_list">
						</datalist>
						<br/>
					</form>

					
					<label for="date">Quando si terr&agrave; l'evento?</label><br>
					<input type="date" name="date">
					<input type="time" value="13:30" name="time">

					
					<label for="img">Inserisci un'immagine per l'evento</label>
					<input id="img" type="file" name="file" accept="image/png, image/jpeg"/>

					<label for="description">Descrivi il tuo evento</label>
					<textarea name="description" id="description" rows="7" placeholder="Descrizione"></textarea>

					<div class="column">
						<label>Tipo di evento</label>
						<select name="categories">
							<?php 
								$categories = get_categories();
								for($i = 0; $i < count($categories); $i++) {
									echo "<option value=".$categories[$i].">" . $categories[$i] . "</option>";
									// echo '<input type="checkbox" id="categoria' . $i . '" name="test" value="test">';
									// echo '<label for="categoria' . $i . '">' .$categories[$i]. '</label>';
									// echo "</div>";
								}
							?>
						</select>
					</div>
					
					Il biglietto sar&agrave gratuito o a pagamento?
					<div class="radio-choice">
						<input type="radio" id="radioChoice1" name="price-choice" onclick="hide('price-input');" value="free">
						<label for="radioChoice1">Gratuito</label><br>
					
						<input type="radio" id="radioChoice2" name="price-choice" onclick="show('price-input');" value="pay">
						<label for="radioChoice2">A pagamento</label><br>
						

					</div>
					<div class="price-input" id="price-input">
						<label for="price">Inserisci il prezzo del biglietto</label>
						<input type="text" id="price" name="ticket-price">
					</div>
				
					<button type="submit" >Crea evento</button>


				</div>

					<!-- <div style="overflow:auto;">
						<div style="float:right;">
							<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
							<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
						</div>
					</div> -->
					<!-- Circles which indicates the steps of the form: -->
					<!-- <div style="text-align:center;margin-top:40px;">
					<span class="step"></span>
					<span class="step"></span> -->

			</form>

		</div>
	
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