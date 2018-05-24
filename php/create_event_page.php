<?php 
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbConfig.php';
include 'query.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<script src="../js/login.js"></script>
	<script src="../js/slideshow.js"></script>
	


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
			?>
		</header>
		

		<div class="content">
			<form class="creation-form">
				<h1>Crea il tuo nuovo evento</h1>

				<div class="tab">
					<label for="name">Dai un nome al tuo evento</label>
					<input id="name" type="text" placeholder="Nome evento">

					<label for="city">Località</label>
					<form autocomplete="off">
						<div class="autocomplete">
							<input id="myInput" type="text" placeholder="Città" name="country">
						</div>
					</form>
					
					<label for="description">Descrivi il tuo evento</label>
					<textarea name="description" id="description" rows="7" placeholder="Descrizione"></textarea>

					<label for="img">Inserisci un'immagine per l'evento</label>
					<input id="img" type="file" name="file" accept="image/png, image/jpeg"/>

					<div>
						<label for="date">Quando si terrà l'evento?</label>
						<input type="date">
						<input type="time" value="13:30">
					</div>
				</div>

				<div class="tab">Contact Info:
					<p><input placeholder="E-mail..." oninput="this.className = ''"></p>
					<p><input placeholder="Phone..." oninput="this.className = ''"></p>
				</div>

				<div style="overflow:auto;">
				<div style="float:right;">
					<button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
					<button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
				</div>
				</div>
								<!-- Circles which indicates the steps of the form: -->
				<div style="text-align:center;margin-top:40px;">
				<span class="step"></span>
				<span class="step"></span>
				</div>

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
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
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
	var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "flex";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "flex";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
//   if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}


function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>