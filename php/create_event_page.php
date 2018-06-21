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
	<script src="../js/create_test.js"></script>
	


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
					<form autocomplete="off">
						<div class="autocomplete">
							<input id="myInput" type="text" placeholder="Citt&agrave;" name="country">
						</div>
					</form>

					
					<label for="date">Quando si terr&agrave; l'evento?</label><br>
					<input type="date" name="date">
					<input type="time" value="13:30" name="time">

					
					<label for="img">Inserisci un'immagine per l'evento</label>
					<input id="img" type="file" name="file" accept="image/png, image/jpeg"/>
					<!-- <form class="upload-img" action="./upload.php" method="POST" enctype="multipart/form-data">
						<input type="file" name="file" accept="image/png, image/jpeg"/>
						<button type="submit" name="btn-upload">Upload</button>
					</form> -->

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

	<?php
		$query = "SELECT nome FROM comuni";
		
		$result = $bongoDb->performQuery($query);
		$i = 0;
		while($row = $result->fetch_assoc()) {
			$cities[] = htmlentities($row['nome']);
		}
	?>

	<script type="text/javascript">
	var countries = <?php echo json_encode($cities, JSON_HEX_TAG); ?>; 










	function reqListener () {
		console.log(this.responseText);
	}

	var oReq = new XMLHttpRequest(); //New request object
	oReq.onload = function() {
			//This is where you handle what to do with the response.
			//The actual data is found on this.responseText
			console.log(this.responseText); //Will alert: 42
	};
	oReq.open("get", "gethint.php", true);
	//                               ^ Don't block the rest of the execution.
	//                                 Don't wait until the request finishes to 
	//                                 continue.
	oReq.send();
	</script>

	<script src="../js/test.js"></script>

</body>

</html>

<script>
// 	var currentTab = 0; // Current tab is set to be the first tab (0)
// showTab(currentTab); // Display the current tab

// function showTab(n) {
//   // This function will display the specified tab of the form ...
//   var x = document.getElementsByClassName("tab");
//   x[n].style.display = "flex";
//   // ... and fix the Previous/Next buttons:
//   if (n == 0) {
//     document.getElementById("prevBtn").style.display = "none";
//   } else {
//     document.getElementById("prevBtn").style.display = "flex";
//   }
//   if (n == (x.length - 1)) {
//     document.getElementById("nextBtn").innerHTML = "Submit";
//   } else {
//     document.getElementById("nextBtn").innerHTML = "Next";
//   }
//   // ... and run a function that displays the correct step indicator:
//   fixStepIndicator(n)
// }

// function nextPrev(n) {
//   // This function will figure out which tab to display
//   var x = document.getElementsByClassName("tab");
//   // Exit the function if any field in the current tab is invalid:
// //   if (n == 1 && !validateForm()) return false;
//   // Hide the current tab:
//   x[currentTab].style.display = "none";
//   // Increase or decrease the current tab by 1:
//   currentTab = currentTab + n;
//   // if you have reached the end of the form... :
//   if (currentTab >= x.length) {
//     //...the form gets submitted:
//     document.getElementById("regForm").submit();
//     return false;
//   }
//   // Otherwise, display the correct tab:
//   showTab(currentTab);
// }


// function fixStepIndicator(n) {
//   // This function removes the "active" class of all steps...
//   var i, x = document.getElementsByClassName("step");
//   for (i = 0; i < x.length; i++) {
//     x[i].className = x[i].className.replace(" active", "");
//   }
//   //... and adds the "active" class to the current step:
//   x[n].className += " active";
// }
</script>