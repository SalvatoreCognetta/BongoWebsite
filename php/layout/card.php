<?php
	function create_event_card($id, $img, $title, $description, $date, $time, $price) {
		$card = sprintf("
		<div class='card-margin'>
			%s
		
		</div>
			", card($id, $img, $title, $description, $date, $time, $price));

		echo $card;
	}


	function create_modify_card($id, $img, $title, $description, $date, $time, $price) {
		// $list = 
		$card = sprintf("
		<div class='card-margin'>
			%s
			<a title='Modifica l&#39;evento' class='wrapper-icon' href='./modify_event.php?id=%s'><img class='modify-icon' src='../img/icon/modify.png'></a>
			<span title='Lista di partecipanti' class='wrapper-icon' onclick='show_participants(%s%s%s);'><img class='modify-icon' src='../img/icon/list-circle-blue.png'></span>
			<a title='Elimina evento' class='wrapper-icon' href=''><img class='modify-icon' src='../img/icon/delete.svg'></a>

		</div>
			", card($id, $img, $title, $description, $date, $time, $price), $id, '"', $id, '"');

		echo $card;
	}

	function create_delete_card($id, $img, $title, $description, $date, $time, $price) {
		$card = sprintf("
		<div class='card-margin'>
			%s
			<a title='Annulla partecipazione' class='wrapper-icon' href='./del_partecipation.php?id=%s'><img class='modify-icon' src='../img/icon/delete.svg'></a>

		</div>
			", card($id, $img, $title, $description, $date, $time, $price), $id);

		echo $card;
	}

	function card($id, $img, $title, $description, $date, $time, $price) {
		$card = sprintf("
		<a href='./event_page.php?id=%s'>
		
			<div class='event_card'> 
				<img src=' %s ' alt='Immagine evento'>
				<div class='event_card-info'>
					<h2> %s </h2> 				
					<p> %s </p>
				</div>
				<div class='event_card-date'>
					<div class='event_card-date-info'>
						<h3>Data: </h3>
						<p> %s </p>
					</div>
					
					<div class='event_card-date-info'>
						<h3>Ora: </h3>
						<p> %s </p>
					</div>

					<div class='event_card-date-info'>
						<h3>Prezzo: </h3>
						<p> %s&euro; </p>
					</div>
					
				</div>
			</div>
		</a>", $id, $img, $title, $description, $date, $time, $price);

		return $card;
	}


	// function create_event_card($id_event) {
	// 	$event = get_event($id_event);
	// 	$timestamp = strtotime($event['date']);
	// 	$date = date('d-m-Y', $timestamp);
	// 	$time = date('H:i', $timestamp);

	// 	$card = sprintf("
	// 	<div class='card-margin'>
	// 	<a href='./event_page.php?id=%s'>
		
	// 		<div class='event_card'> 
	// 			<img src=' %s ' alt='Immagine evento'>
	// 			<div class='event_card-info'>
	// 				<h2> %s </h2> 				
	// 				<p> %s </p>
	// 			</div>
	// 			<div class='event_card-date'>
	// 				<div class='event_card-date-info'>
	// 					<h3>Data: </h3>
	// 					<p> %s </p>
	// 				</div>
					
	// 				<div class='event_card-date-info'>
	// 					<h3>Ora: </h3>
	// 					<p> %s </p>
	// 				</div>

	// 				<div class='event_card-date-info'>
	// 					<h3>Prezzo: </h3>
	// 					<p> %s&euro; </p>
	// 				</div>
					
	// 			</div>
	// 		</div>
	// 	</a>
	// 	</div>
	// 		",$id_event, get_event_img_location($id_event) , $event['title'], $event['description'], $date, $time, $event['price']);

	// 		echo $card;
	// }

	function create_error_card() {
		$card = "<div class='error_card'>Nessun evento trovato nel nostro database.</div>";
		echo $card;
	}
?>