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
	
		function get_avatar_location($user_id) {	
			global $bongoDb;
			$query = "SELECT location FROM upload INNER JOIN user ON idavatar = uidimg WHERE userid = ?";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
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

		function get_img_location($id_img) {
			global $bongoDb;
			
			$query = "SELECT location FROM upload WHERE uidimg = ?";
			$result = $bongoDb->performQueryWithParameters($query, "s", $id_img);
			

			$numRow = $result->num_rows;
			if($numRow == 0) 
				return null;
			else {
				$result = $result->fetch_assoc();
				return $result['location'];
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

		function insert_event($user_id, $params) {
			global $bongoDb;
			$query = "INSERT INTO evento (idevent, title, city, date, description, category, price, img, uid_creator) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
			$params[] = $user_id;
			$result = $bongoDb->performQueryWithParameters($query, "ssssssdss", $params);
			// $row = $result->fetch_assoc();
		}

		function update_avatar($user_id, $uid_img) {
			global $bongoDb;

			$query = "UPDATE user SET idavatar = '$uid_img' WHERE userid = '$user_id'";
			$result = $bongoDb->performQuery($query);
		}

		function get_past_events($user_id) {
			global $bongoDb;
			$query = "SELECT * FROM partecipazione_evento INNER JOIN evento ON evento = idevent WHERE user =  ? AND date < now() ORDER BY date DESC";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			

			return $result;
		}

		function get_future_events($user_id) {
			global $bongoDb;
			$query = "SELECT * FROM partecipazione_evento INNER JOIN evento ON evento = idevent WHERE user =  ? AND date >= now() ORDER BY date";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			

			return $result;
		}

		function get_created_events($user_id) {
			global $bongoDb;
			$query = "SELECT * FROM evento WHERE uid_creator =  ? ORDER BY date DESC";
			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			

			return $result;
		}

		function partecipate_event($user_id, $id_event) {
			global $bongoDb;
			$params = array($id_event, $user_id);
			$query = "INSERT INTO partecipazione_evento (evento, user) VALUES(?, ?);";

			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);

			$query = "UPDATE evento SET numParticipants = numParticipants+1 WHERE idevent = '$id_event';";
			$result = $bongoDb->performQuery($query);
		}

		function del_partecipation($user_id, $id_event) {
			global $bongoDb;
			$params = array($id_event, $user_id);
			$query = "DELETE FROM partecipazione_evento WHERE evento = ? AND user = ?;";

			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);

			$query = "UPDATE evento SET numParticipants = numParticipants-1 WHERE idevent = '$id_event';";
			$result = $bongoDb->performQuery($query);
		}

		function already_partecipates($user_id, $id_event) {
			global $bongoDb;
			$params = array($user_id, $id_event);
			$query = "SELECT * FROM partecipazione_evento WHERE user = ? and evento = ?";
			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);

			if($result->num_rows != 0)
				return true;
			return false;
		}

		function upload_img($file_name, $file) {
			global $bongoDb;

			$query = "INSERT INTO `upload` (uidimg, location) VALUES (?, ?)";

			$params = array($file_name, $file);
			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);
		}

		function get_user_info($user_id) {
			global $bongoDb;

			$query = "SELECT username, fullname, email FROM user WHERE userid = ?";

			$result = $bongoDb->performQueryWithParameters($query, "s", $user_id);
			
			$numRow = $result->num_rows;
			if($numRow == 0) 
				return null;
			else {
				if($row = $result->fetch_assoc()) 
					return $row;
			}
		}

		function update_user_info($user_id, $params) {
			global $bongoDb;

			$query = "UPDATE user SET username = ?, fullname = ?, email = ? WHERE userid = ?";
	
			array_push($params, $user_id);
			$result = $bongoDb->performQueryWithParameters($query, "ssss", $params);

		}

		function authenticate($username, $password){   
			global $bongoDb;
			$username = $bongoDb->sqlInjectionFilter($username);
			$password = $bongoDb->sqlInjectionFilter($password);
		
			$query = "
					SELECT userid, username, password
					FROM user
					WHERE username = ?";
		

			
			$result = $bongoDb->performQueryWithParameters($query, "s", $username);
		
		
			$numRow = $result->num_rows;
			if ($numRow != 1)
				return -1;
			
			$userRow = $result->fetch_assoc();
			
			if(password_verify($password, $userRow['password'])){
				return $userRow['userid'];
			}
			else{
				return -1;
			}
		
			
				
		}

		function user_already_exist($username, $email){
			//Controllo se c'è già un utente registrato con quella mail e/o username	
			global $bongoDb;
			$username = $bongoDb->sqlInjectionFilter($username);
			$email = $bongoDb->sqlInjectionFilter($email);
	
			$query = "
				SELECT username, email
				FROM user
				WHERE username = ? OR email = ?";
			
			$params = array($username, $email);
			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);
	
			return $result;
		}

		function create_user($username, $email, $fullname, $password){
			global $bongoDb;
			$username = $bongoDb->sqlInjectionFilter($username);
			
			$password = $bongoDb->sqlInjectionFilter($password);
			
			$userid = uniqid("user_");
			
			$query = "INSERT INTO user (`userid`, `username`, `email`, `fullname`, `password`) VALUES (?, ?, ?, ?, ?);";
			
			$params = array($userid, $username, $email, $fullname, $password);

			$result = $bongoDb->performQueryWithParameters($query, "sssss", $params);

			
			return $userid;
		}

		function update_psw($user_id, $password) {
			global $bongoDb;


			$query = "UPDATE user SET password = ? WHERE userid = ?";
	
			$params = array($password, $user_id);
			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);

		}

		function is_event_creator($user_id, $id_event) {
			global $bongoDb;

			$query = "
				SELECT COUNT(*) AS creator
				FROM evento
				WHERE idevent = ? AND uid_creator = ?";
			
			$params = array($id_event, $user_id);
			$result = $bongoDb->performQueryWithParameters($query, "ss", $params);
			$result = $result->fetch_assoc();

			if($result['creator'] == 1)
				return true;
			return false;
		}


		function update_event($id_event, $parameters) {
			global $bongoDb;

			$query = "
				UPDATE evento SET ";

				$query = "
				UPDATE evento SET ";

				$num_params = count($parameters);

				$parameters_type = "";

				for($i = 0; $i < $num_params; $i++) {
					$query .= $parameters[$i]->name . " = ?";
					echo $parameters[$i]->name . '=' . $parameters[$i]->value . ' ';
					$parameters_type .=  $parameters[$i]->type;
					$params[] =  $parameters[$i]->value;
					if($i != $num_params-1)
						$query .= ', ';
				}


				$query .= " WHERE idevent = ?"; 

				//Aggiungo l'id dell'evento alla lista di parametri da passare alla funzione
				$params[] = $id_event;
				$parameters_type .= "s";
				
				$result = $bongoDb->performQueryWithParameters($query, $parameters_type, $params);
				
			}


			function get_participants($id_event) {
				global $bongoDb;

				$query = "SELECT fullname FROM partecipazione_evento INNER JOIN user ON user = userid  WHERE evento = ?";

				$result = $bongoDb->performQueryWithParameters($query, "s", $id_event);
				
				$numRow = $result->num_rows;
				if($numRow == 0) 
					return null;
				return $result;
				
			}

?>
