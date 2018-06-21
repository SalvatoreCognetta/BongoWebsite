<?php
	function create_event_card($id, $img, $title, $description, $date, $time, $price) {
		$card = sprintf("
		<div class='card-margin'>
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
		</a>
		</div>
			",$id, $img, $title, $description, $date, $time, $price);

			echo $card;
	}


	function create_error_card() {
		$card = "<div class='error_card'>Nessun evento trovato nel nostro database.</div>";
		echo $card;
	}
?>