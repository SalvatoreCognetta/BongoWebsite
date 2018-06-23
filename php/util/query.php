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
	
			global $bongoDb;
			
			$query .= " ORDER BY date";
			$result = $bongoDb->performQueryWithParameters($query, $parameters_type, $parameters);

			return $result;
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

		function get_event_img_location($idevent) {
			global $bongoDb;
			$query = "SELECT location FROM upload INNER JOIN evento ON img = uidimg WHERE idevent = ?";
			$result = $bongoDb->performQueryWithParameters($query, "s", $idevent);
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

		function get_event($id_event) {
			global $bongoDb;
			
			$query = "SELECT * FROM evento WHERE idevent = ?";
			$result = $bongoDb->performQueryWithParameters($query, "s", $id_event);
			

			$numRow = $result->num_rows;
			if($numRow == 0) 
				return null;
			else {
				if($row = $result->fetch_assoc()) 
					return $row;
			}
		}

		function insert_event($params) {
			global $bongoDb;
			$query = "INSERT INTO evento (idevent, title, city, date, description, category, price, img, uid_creator) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";

			$result = $bongoDb->performQueryWithParameters($query, "ssssssdss", $params);
			// $row = $result->fetch_assoc();
		}

		function update_avatar($uid_img) {
			global $bongoDb;
			//Questa porzione di codice deve essere eseguita solo per l'aggiornamento dell'immagine del profilo!!!
			$userid = $_SESSION['userid'];

			$query = "UPDATE user SET idavatar = '$uid_img' WHERE userid = '$userid'";
			$result = $bongoDb->performQuery($query);
		}

		function get_past_events($user_id) {
			global $bongoDb;
			$query = "SELECT * FROM partecipazione_evento INNER JOIN evento ON evento = idevent WHERE user =  ? AND date < now() ORDER BY date";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			

			return $result;
		}

		function get_future_events($user_id) {
			global $bongoDb;
			$query = "SELECT * FROM partecipazione_evento INNER JOIN evento ON evento = idevent WHERE user =  ? AND date >= now() ORDER BY date";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			

			return $result;
		}

		function partecipate_event($id_event) {
			global $bongoDb;
			$params = array($id_event, $_SESSION['userid']);
			$query = "INSERT INTO partecipazione_evento (evento, user) VALUES(?, ?);";

			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);
		}

		

?>
