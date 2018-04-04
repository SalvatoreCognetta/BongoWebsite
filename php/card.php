<?php
	function create_event_card($img, $title, $description, $date, $time, $price) {
		$card = sprintf("
			<div class=\"event_card\"> 
				<img src=\" %s \">
				<div class=\"event_card-info\">
					<h2> %s </h2> 				
					<p> %s </p>
				</div>
				<div class=\"event_card-date\">
					<div class=\"event_card-date-info\">
						<h3>Data: </h3>
						<p> %s </p>
					</div>
					
					<div class=\"event_card-date-info\">
						<h3>Ora: </h3>
						<p> %s </p>
					</div>

					<div class=\"event_card-date-info\">
						<h3>Prezzo: </h3>
						<p> %s€ </p>
					</div>
					
					<button class=\"event_card-button\">></button>
				</div>
			</div>", $img, $title, $description, $date, $time, $price);

			echo $card;
	}


	function create_error_card() {
		$card = "<div class=\"error_card\">Nessun evento trovato nel nostro database.</div>";
		echo $card;
	}
?>