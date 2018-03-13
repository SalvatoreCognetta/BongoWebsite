<?php
	//Ad ogni item dei filtri viene associato un nome, tipo(necessario per il bind_param sulla prepared statement), il valore del filtro e l'operatore della query assocciato.
	class filter_value {
		public $name;
		public $type;
		public $value;
		public $operator;
	}


	//La funzione bool mysqli_stmt::bind_result ( mixed &$var1 [, mixed &$... ] ) necessita di parametri riferimento
	function refValues($arr){
		$refs = array();
		foreach($arr as $key => $value) 
			$refs[$key] = &$arr[$key];
		return $refs;
	}


	// Determina il tipo dell'argomento da passare alla funzione bind_param, partendo dal gettype() del valore inserito
	function det_param_type($type) {
		// 	The argument may be one of four types:

		// i - integer
		// d - double
		// s - string
		// b - BLOB
		switch ($type) {
			case "integer":
				return "i";
			case "double":
				return "d";
			case "string":
				return "s";
			default:
				echo "Valore inserito non valido";
				return false;
		}
	}
?>