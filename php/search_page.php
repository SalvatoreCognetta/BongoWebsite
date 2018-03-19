<!DOCTYPE html>
<html lang="it">

<head>
	<?php require 'config.php'?>
	<title>Bongo</title>
	<link href="../css/reset.css" rel="stylesheet" type="text/css">
	<link href="../css/styleTest.css" rel="stylesheet" type="text/css">

</head>

<body>
	<div class="wrapper"> 	<!-- Necessario per lo sticky footer -->
		<header>
			<nav class="main-nav">
				<h1 class="logo">Bongo</h1>
				<ul class="main-nav-list">
					<li>
						<a href="../html/home.html">Home</a>
					</li>
					<li>
						<a href="../html/login.html">Accedi</a>
					</li>
					<li>
						<a href="../html/signin.html">Registrati</a>
					</li>
					<li>
						<a href="../html/help.html">Aiuto</a>
					</li>
					<li>
						<a href="../html/about.html">Chi siamo</a>
					</li>
				</ul>
			</nav>
		</header>

		<!-- <section class="cards">
			<article class="card">
				<img src="../img/img_fjords.jpg">
				<div class="card-info">
					<h2>Titolo</h2> 				
					<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
				</div>
				<div class="card-date">
					<div class="card-date-info">
						<h3>Data: </h3>
						<p>22/01/2018</p>
					</div>
					
					<div class="card-date-info">
						<h3>Ora: </h3>
						<p>22:30</p>
					</div>

					<div class="card-date-info">
						<h3>Prezzo: </h3>
						<p>5€</p>
					</div>
					
					<button class="card-button">></button>
				</div>
			</article>
		</section> -->


		<section class="content">

			<aside class="side-filter">
				<form class="filter-form" action="search_page.php" method="get">
					<input type="text" name="title" placeholder="Filtra">
					<fieldset class="filter-form-item">
						<legend>Categoria eventi</legend>
						<input type="checkbox" name="category" value="test1">test<br/>
					</fieldset>
					<input type="date" name="date" >
					<select name="city">
						<option value="" disabled selected>Città</option>
						<option value="Pisa">Pisa</option>
					</select>						
					<input type="submit" value="Cerca"	>
				</form>
			</aside>

			<!-- <nav class="filter-nav">
				<form action="search_page.php" method="get">
					<div class="filter-form">
						<input type="text" name="title" placeholder="Filtra">
						<select name="category">
							<option value="" disabled selected>Categoria</option>
							<option value="test1">test1</option>
							<option value="test2">test2</option>
						</select>
						<input type="date" name="date" >
						<select name="city">
							<option value="" disabled selected>Città</option>
							<option value="Pisa">Pisa</option>
						</select>						
						<input type="submit" value="Cerca">
					</div>
				</form>
			</nav> -->

			<?php
			require 'connection.php';
			include 'query.php';
			include 'utility.php';
			$values = array_filter($_GET);

			$filter_values	 = array();
			$filter_values[] = new filter_value('title', 's', $_GET['title'], 'LIKE');
			$filter_values[] = new filter_value('category', 's', $_GET['category'], '=');
			$filter_values[] = new filter_value('city', 's', $_GET['city'], '=');
			echo "filter value: ";
			print_r($filter_values);
			echo "\n";

$arr = array();

			// foreach($values as $key => $value) {
			// 	$filter_item 			= new filter_value();
			// 	$filter_item->name 		= $key;
			// 	if($ret = det_param_type(gettype($value))) {
			// 		$filter_item->type 	= $ret;	
			// 	} else {
			// 		//caso in cui il valore inserito non è un int, string o double
			// 	}
			// $filter_item->value 		= $value;
			// 	// $filter_item->operator	= ;
			// 	array_push($arr, $filter_item);
			// }
			// print_r($arr);
			

			

			// $text_filter			= new filter_value();
			// $text_filter->name		= "title";
			// $text_filter->type 		= "s";
			// $text_filter->operator 	= "LIKE";

			$params = array('title' => 's', 'category' => 's', 'date' => 's', 'city' => 's');
			$res = filter_query($params);
			// print_r($res);

			$no_value	 = $res[0];
			$query		 = $res[1];
			$bind_params = $res[2];

			$stmt = $conn->prepare($query);

			

			if(!$no_value) {
				call_user_func_array(array($stmt, "bind_param"), refValues($bind_params)); 
				//Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))
				/*In programmazione, un callback (o, in italiano, richiamo) è, in genere, una funzione, o un "blocco di codice" che viene passata come parametro ad un'altra funzione. In particolare, quando ci si riferisce alla callback richiamata da una funzione, la callback viene passata come argomento ad un parametro della funzione chiamante. In questo modo la chiamante può realizzare un compito specifico (quello svolto dalla callback) che non è, molto spesso, noto al momento della scrittura del codice. [Wikipedia]*/
			}


			//Eseguo la query
			$stmt->execute();

			$result = $stmt->get_result();




			if(!$result)
				echo "Errore nella query.";

			if ($result->num_rows > 0) {
				$createCard = function($img, $title, $description, $date, $price)
				{
					printf("Hello %s\r\n", $name);
				};

				// output data of each row
				echo "<section class=\"cards\">";
				while($row = $result->fetch_assoc()) {
					$timestamp = strtotime($row["date"]);
					$date = date('d-m-Y', $timestamp);
					$time = date('H:i', $timestamp);

					

					$str = "
					<article class=\"card\"> 
						<img src=\"".$row["img"]."\">
						<div class=\"card-info\">
							<h2>".$row["title"]."</h2> 				
							<p>".$row["description"]."</p>
						</div>
						<div class=\"card-date\">
							<div class=\"card-date-info\">
								<h3>Data: </h3>
								<p>".$date."</p>
							</div>
							
							<div class=\"card-date-info\">
								<h3>Ora: </h3>
								<p>".$time."</p>
							</div>

							<div class=\"card-date-info\">
								<h3>Prezzo: </h3>
								<p>".$row["price"]."</p>
							</div>
							
							<button class=\"card-button\">></button>
						</div>
					</article>";

					echo $str;
				}
				echo "</section>";
			} else {
				echo "0 results";
			}
			$conn->close();
			?>


		</section>
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