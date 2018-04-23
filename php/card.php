<?php
	function create_event_card($id, $img, $title, $description, $date, $time, $price) {
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
					
					<a href=\"./event_page.php?id=%d\"><button type=\"button\" class=\"event_card-button\"> > </button></a>
				</div>
			</div>", $img, $title, $description, $date, $time, $price, $id);

			echo $card;
	}


	function create_error_card() {
		$card = "<div class=\"error_card\">Nessun evento trovato nel nostro database.</div>";
		echo $card;
	}
?>