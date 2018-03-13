<?php
	function filter_query($params) {
		$query = "
			SELECT *
			FROM evento
		";

		$noValue = true;	// se non c'è nessuno valore nei filtri, cioè l'utente clicca 'Cerca' senza inserire nulla, la query non deve contenere nessun where.
		$numParams = 0;
		foreach ($params as $field => $value) {
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
			
			foreach($params as $field => $value) {
				if(!empty($_GET[$field])){

					$bind_param_args[0] .= $value;
					
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

		$query .= " ORDER BY date";
		$ret = array($noValue, $query, $bind_param_args);
		return $ret;
	

	}

// 	function refValues($arr){
// 		$refs = array();
// 		foreach($arr as $key => $value) 
// 			$refs[$key] = &$arr[$key];
// 		return $refs;
// }
?>