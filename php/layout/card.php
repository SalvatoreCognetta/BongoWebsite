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
		$func = "show_participants('" . $id . "');";
		$card = sprintf('
		<div class="card-margin">
			%s
			<a title="Modifica l&#39;evento" class="wrapper-icon" href="./modify_event.php?id=%s"><img class="modify-icon" src="../img/icon/modify.png" alt="Modifica"></a>
			<span title="Lista di partecipanti" class="wrapper-icon" onclick="%s"><img class="modify-icon" src="../img/icon/list-circle-blue.png" alt="Partecipanti"></span>

		</div>
			', card($id, $img, $title, $description, $date, $time, $price), $id, $func);

		echo $card;
	}

	function create_delete_card($id, $img, $title, $description, $date, $time, $price) {
		$card = sprintf("
		<div class='card-margin'>
			%s
			<a title='Annulla partecipazione' class='wrapper-icon' href='./del_partecipation.php?id=%s'><img class='modify-icon' src='../img/icon/delete.svg' alt='Elimina'></a>

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


	function create_error_card() {
		$card = "<div class='error_card'>Nessun evento trovato nel nostro database.</div>";
		echo $card;
	}
?>