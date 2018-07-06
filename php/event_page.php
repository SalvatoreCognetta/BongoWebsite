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
	<script src="../js/test.js"></script>


	<title>Bongo</title>
	<!-- <link href="../css/home.css" rel="stylesheet" type="text/css"> -->

	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/allpages.css" rel="stylesheet" type="text/css">
	<link href="../css/login.css" rel="stylesheet" type="text/css">
	<link href="../css/event_page.css" rel="stylesheet" type="text/css">

	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">


</head>

<body>
	<!-- Necessario per lo sticky footer -->
	<div class="wrapper">
		<header>
			<?php 
			include DIR_BASE . 'login_form.php'; 
			include DIR_BASE . 'nav_bar.php';   
			
			$id_event = $_GET['id'];
			$row = get_event($id_event);


			$img = get_event_img_location($id_event);
			$title = $row[$titlecol];
			// $date = $row['date'];

			$timestamp = strtotime($row[$datecol]);
			$date = date('d-m-Y', $timestamp);
			$time = date('H:i', $timestamp);

			$place = $row['city'];

			$description = $row[$descol];	
			
			$category = $row['category'];

			$num_p = $row['numParticipants'];

			$price = $row['price'];

			$creator_info = get_user_info($row['uid_creator']);
			$creator = $creator_info['fullname'];

			?>
				
		</header>

		<div class="stripes">
			<span></span>
		</div>	


		<div class="event-container">
			<div class="wrapper-flex">
				<img class='event-img' src='<?php echo $img; ?>' alt='Immagine evento'>
				<aside class="wrapper-info">
					<h1 class="title"><?php echo $title;?></h1>
					
					
					
					<div class="event-info">
						<h2 class="info"><?php echo $date . " " . $time;?></h2>
						<h2 class="info"><?php echo $place;?></h2>
						<h2 class="info">Categoria: <?php echo $category;?></h2>
						<h2 class="info">Numero di partecipanti: <?php echo $num_p;?></h2>
						<h2 class="info">Prezzo biglietto: <?php echo $price;?>&euro;</h2>
						<h2 class="info">Creatore evento: <?php echo $creator;?></h2>					
					</div>
					<div class="wrapper-partecipate">
				<?php 
					if(isLogged()) {
						if(!is_event_creator($_SESSION['userid'], $_GET['id'])){
							if(!already_partecipates($_SESSION['userid'], $id_event)) {
					?>

					<form method="get" action="./partecipate.php">
						<input type="hidden" name="event" value="<?php echo $id_event;?>" />
						<button class="btn btn-partecipate" name="btn">Partecipa</button>
					</form>

					<?php 
							} else {
					?>

					<form method="get" action="./del_partecipation.php">
						<input type="hidden" name="event" value="<?php echo $id_event;?>" />
						<button class="btn btn-undo" name="btn">Non partecipo</button>
					</form>

					<?php
							}
						} else {
					?>
				
					<a class="modify" href="./modify_event.php?id=<?php echo $_GET['id'];?>"><button class="btn btn-modify" title="Modifica l'evento" >Modifica</button></a>

					<?php
						}
					} else {
					?>

					<button class="btn disabled-btn" title="Per partecipare all'evento devi accedere" disabled>Partecipa</button>
					
					<?php
					}
					?>
					</div>
				</aside>
				<!-- $row['date']; -->
				

				<!-- echo $id_event; -->

			</div>

			<article class="event-description"><?php echo $description; ?></article>
			
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