<?php
	$query = "
		SELECT *
		FROM evento
	";
	
	$dbParams = array('');
	$params = array('title', 'categories', 'date', 'city'); //Ho supposto che i name dei campi del filter-form siano corrispondenti ai nomi delle colonne della tabella nel db

	$noValue = true;		// se non c'è nessuno valore nei filtri, cioè l'utente clicca 'Cerca' senza inserire nulla, la query non deve contenere nessun where.
	$numParams = 0;
	foreach ($params as $field) {
		if (!empty($_GET[$field])) {
			if($noValue) {
				$query .= "WHERE ";
				$noValue = false;
			}
			$numParams++;
		}
	}

	$bind_param_args = array();
	$bind_param_args[0] = "";
	if(!$noValue){
		foreach($params as $field) {
			if(!empty($_GET[$field])){	// $_GET[$field]!= null è necessario perchè il campo title anche se vuoto ha valore ""

				$bind_param_args[0] .= "s";
				
				if($field == "title") {
					$param = "%{$_GET[$field]}%";
					$str = sprintf("%s LIKE ?", $field);
				} else {
					$param = $_GET[$field];					
					$str = sprintf("%s = ? ", $field);
				}
				array_push($bind_param_args, $param);

				$query .= $str;

				$numParams--;
				
				if($numParams > 0) {
					$query .= " AND ";
				}

			}
		}
	}
	print_r($bind_param_args);

	$query .= " ORDER BY date";
	echo $query;
	
	$stmt = $conn->prepare($query);

// 	The argument may be one of four types:

// i - integer
// d - double
// s - string
// b - BLOB

	$a_param_type = array("s", "i", "d", "b");


		
	//now we need to add references
	$tmp = array();
	foreach($bind_param_args as $key => $value) $tmp[$key] = &$bind_param_args[$key];

	function refValues($arr){
			$refs = array();
			for ($i = 0; $i < count($arr); $i++)
				$refs[$i] = & $arr[$i];
			return $refs;
	}

	if(!$noValue) {
		call_user_func_array(array($stmt, "bind_param"), $tmp); //Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))
		/*In programmazione, un callback (o, in italiano, richiamo) è, in genere, una funzione, o un "blocco di codice" che viene passata come parametro ad un'altra funzione. In particolare, quando ci si riferisce alla callback richiamata da una funzione, la callback viene passata come argomento ad un parametro della funzione chiamante. In questo modo la chiamante può realizzare un compito specifico (quello svolto dalla callback) che non è, molto spesso, noto al momento della scrittura del codice. */
	}

	
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