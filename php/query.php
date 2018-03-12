<?php
	$query = "
		SELECT *
		FROM evento
	";
	
	$paramsWeight = array("title" => 1, "categories" => 3, "date" => 5, "city" => 13); //Associo ad ogni filtro un peso, in modo da sapere quali filtri sono stati inseriti, semplicemente facendo la somma dei pesi.

	$dbParams = array('');
	$params = array('title', 'categories', 'date', 'city'); //Ho supposto che i name dei campi del filter-form siano corrispondenti ai nomi delle colonne della tabella nel db

	$noValue = true;		// se non c'è nessuno valore nei filtri, cioè l'utente clicca 'Cerca' senza inserire nulla, la query non deve contenere nessun where.
	foreach ($params as $field) {
		if (isset($_GET[$field])) {
			$query .= "WHERE ";
			$noValue = false;
			break;
		}
	}
	
	$totalWeight = 0;

	$bind_param_args = array();
	$bind_param_args[0] = "";
	if(!$noValue){
		foreach($params as $field) {
			if(isset($_GET[$field]) && $_GET[$field]!= null){	// $_GET[$field]!= null è necessario perchè il campo title anche se vuoto ha valore ""
				echo $field. ": " .$_GET[$field];

				$bind_param_args[0] .= "s";
				array_push($bind_param_args,'$'. $field);

				$str = sprintf("%s = '%s' ", $field, $_GET[$field]);
				$query .= $str;

				$totalWeight += $paramsWeight[$field];

				if($field != $params[count($params)-1]) {
					$query .= " AND ";
				}
			}
		}
	}
	print_r($bind_param_args);
	echo $bind_param_args[1];

	$query .= " ORDER BY date";
	echo $query;
	
	$stmt = $conn->prepare($query);



	$a_param_type = array("s", "i", "d", "b");


	function refValues($arr){
			$refs = array();
			for ($i = 0; $i < count($arr); $i++)
				$refs[$i] = & $arr[$i];
			return $refs;
	}

	call_user_func_array(array($stmt, "bind_param"), refValues($bind_param_args)); //Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))




	// switch ($totalWeight) {
	// 	case 1:
	// 		echo "TESTTTT";
	// 		$stmt->bind_param("s",  $title);
	// 		break;
	// 	case 3:
	// 		$stmt->bind_param("s",  $categories);
	// 		break;
	// 	case 4:
	// 		$stmt->bind_param("ss",  $title, $categories);
	// 		break;
	// 	case 5:
	// 		$stmt->bind_param("s",  $date);
	// 	case 6:
	// 		$stmt->bind_param("ss",  $title, $date);
	// 		break;
	// 	case 8:
	// 		$stmt->bind_param("ss",  $categories, $date);
	// 		break;
	// 	case 9:
	// 		$stmt->bind_param("sss",  $title, $categories, $date);
	// 		break;
	// 	case 13:
	// 		$stmt->bind_param("s",  $city);
	// 		break;
	// 	case 14:
	// 		$stmt->bind_param("ss", $title, $city);
	// 		break;
	// 	case 16:
	// 		$stmt->bind_param("ss", $categories, $city);
	// 		break;
	// 	case 17:
	// 		$stmt->bind_param("sss",  $title, $categories, $city);
	// 		break;
	// 	case 18:
	// 		$stmt->bind_param("sss",  $categories, $date, $city);
	// 		break;
	// 	case 19:
	// 		$stmt->bind_param("sss",  $title, $date, $city);
	// 		break;
	// 	case 22:
	// 		$stmt->bind_param("ssss",  $title, $categories, $date, $city);
	// 		break;
	// }
	
	// $stmt->bind_param("s",  $city);
	
	//Passo i parametri
	// $title = $_GET["event"];
	// $category = $_GET["categories"];
	// $date = $_GET["date"];
	// $city = $_GET["city"];

	//Eseguo la query
	$stmt->execute();

	$result = $stmt->get_result();
	
	
?>

<!-- The argument may be one of four types:

i - integer
d - double
s - string
b - BLOB -->
