<?php
	require_once __DIR__ . "/../config.php";
    require_once DIR_UTIL . "dbManager.php"; //includes Database Class
	 
		//Funzione che, in base ai filtri forniti, restituisce la query da 'preparare' e i bind_params
		function filter_query($params) {
			$query = "
				SELECT *
				FROM evento
			";
		
			$query .= " WHERE ";
	
			$num_params = 0; //numero di parametri già inseriti nella query


			$parameters_type = "";
			
			foreach($params as $field) {
	
				//Creo le condizioni WHERE della query: WHERE... col_name = value
				$str = sprintf("%s %s ?", $field->name, $field->operator);
	
				//Aggiorno i bind_params da dover passare alla funzione mysqli::stmt->bind_param, concatenando il tipo del filter_value a quelli precedentemente inseriti.
				$parameters_type .= $field->type;
	
				//I valori successivi dell'array contengono il valore $_GET['name'])
				$parameters[] = $field->value;
	
				//Aggiorno la query concatenando le condizioni create in precedenza
				$query .= $str;
	
				$num_params++;
	
				//Se non sto inserendo l'ultimo parametro allora aggiungo l'AND
				if($num_params != count($params)) {
					$query .= " AND ";
				}
			}
	
			
			$query .= " ORDER BY date";
			$ret = array($query, $parameters_type, $parameters);
			return $ret;
		}
	
		function get_location($userid) {	
			global $bongoDb;
			$query = "SELECT location FROM upload INNER JOIN user ON idavatar = uidimg WHERE userid = ?";
			$result = $bongoDb->performQueryWithParameters($query, "s", $userid);
			if(!$row = $result->fetch_assoc()) {
				return null;
			} else {
				return $row['location'];
			}
		}

		function get_categories() {
			global $bongoDb;
			
			$query = "SELECT nome FROM categorie";
			$result = $bongoDb->performQuery($query);
			

			$numRow = $result->num_rows;
			if($numRow == 0) 
				return null;
			else {
				while($row = $result->fetch_assoc()) 
					$ret[] = $row['nome'];
			}
			return $ret;
		}

		function insert_event($params) {
			global $bongoDb;
			
			$query = "INSERT INTO evento (title, city, date, description, category, price, img) VALUES(?, ?, ?, ?, ?, ?, ?);";

			$bongoDb->performQueryWithParameters($query, "sssssds", $params);
			

		}
?>