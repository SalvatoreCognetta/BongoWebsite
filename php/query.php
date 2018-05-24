<?
	require_once DIR_UTIL . 'dbConfig.php';
	//Funzione che, in base ai filtri forniti, restituisce la query da 'preparare' e i bind_params
	function filter_query($params) {
		$query = "
			SELECT *
			FROM evento
		";
	
		$query .= " WHERE ";

		$num_params = 0; //numero di parametri già inseriti nella query
		$bind_param_args = array();
		$bind_param_args[0] = "";
		
		foreach($params as $field) {

			//Creo le condizioni WHERE della query: WHERE... col_name = value
			$str = sprintf("%s %s ?", $field->name, $field->operator);

			//Aggiorno i bind_params da dover passare alla funzione mysqli::stmt->bind_param, concatenando il tipo del filter_value a quelli precedentemente inseriti.
			$bind_param_args[0] .= $field->type;

			//I valori successivi dell'array contengono il valore $_GET['name'])
			$bind_param_args[] = $field->value;

			//Aggiorno la query concatenando le condizioni create in precedenza
			$query .= $str;

			$num_params++;

			//Se non sto inserendo l'ultimo parametro allora aggiungo l'AND
			if($num_params != count($params)) {
				$query .= " AND ";
			}
		}

		
		$query .= " ORDER BY date";
		$ret = array($query, $bind_param_args);
		return $ret;
	}

	function get_location($userid) {	
		global $conn;
		$query = "SELECT location FROM upload INNER JOIN user ON idavatar = uidimg WHERE userid = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $userid);
		$stmt->execute();
		$result = $stmt->get_result();
		if(!$row = $result->fetch_assoc()) {
			return null;
		} else {
			return $row['location'];
		}


	}
?>