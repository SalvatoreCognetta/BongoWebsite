<?php
	function create_card($img, $title, $description, $date, $time, $price) {
		$card = sprintf("
			<article class=\"card\"> 
				<img src=\" %s \">
				<div class=\"card-info\">
					<h2> %s </h2> 				
					<p> %s </p>
				</div>
				<div class=\"card-date\">
					<div class=\"card-date-info\">
						<h3>Data: </h3>
						<p> %s </p>
					</div>
					
					<div class=\"card-date-info\">
						<h3>Ora: </h3>
						<p> %s </p>
					</div>

					<div class=\"card-date-info\">
						<h3>Prezzo: </h3>
						<p> %s </p>
					</div>
					
					<button class=\"card-button\">></button>
				</div>
			</article>", $img, $title, $description, $date, $time, $price);

			echo $card;
	}
?>