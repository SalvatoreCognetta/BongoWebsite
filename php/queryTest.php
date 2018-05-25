<?php

// 	The argument may be one of four types:

// i - integer
// d - double
// s - string
// b - BLOB

// $a_param_type = array("s", "i", "d", "b");


	$query = "
		SELECT *
		FROM evento
	";
	
	$params = array('title', 'category', 'date', 'city'); //Ho supposto che i name dei campi del filter-form siano corrispondenti ai nomi delle colonne della tabella nel db

	$noValue = true;	// se non c'è nessuno valore nei filtri, cioè l'utente clicca 'Cerca' senza inserire nulla, la query non deve contenere nessun where.
	$numParams = 0;
	foreach ($params as $field) {
		if (!empty($_GET[$field])) { //La funzione empty() è essenzialmente equivalente a !isset($var)||$var==false. Controlla se la stringa è vuota, NULL, false, ecc.
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
			if(!empty($_GET[$field])){

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
	
	$stmt = $bongoDb->conn->prepare($query);


		
	//La funzione bool mysqli_stmt::bind_result ( mixed &$var1 [, mixed &$... ] ) necessita di parametri riferimento
	function refValues($arr){
			$refs = array();
			foreach($arr as $key => $value) 
				$refs[$key] = &$arr[$key];
			return $refs;
	}

	if(!$noValue) {
		call_user_func_array(array($stmt, "bind_param"), refValues($bind_param_args)); //Call di un metodo all'interndo di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))
		/*In programmazione, un callback (o, in italiano, richiamo) è, in genere, una funzione, o un "blocco di codice" che viene passata come parametro ad un'altra funzione. In particolare, quando ci si riferisce alla callback richiamata da una funzione, la callback viene passata come argomento ad un parametro della funzione chiamante. In questo modo la chiamante può realizzare un compito specifico (quello svolto dalla callback) che non è, molto spesso, noto al momento della scrittura del codice. */
	}


	//Eseguo la query
	$stmt->execute();

	$result = $stmt->get_result();
	

?>