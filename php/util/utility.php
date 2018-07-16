<?php
include_once __DIR__ . '/../config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
	//Ad ogni item dei filtri viene associato un nome, tipo(necessario per il bind_param sulla prepared statement), il valore del filtro e l'operatore della query assocciato.
	class filter_value {
		public $name;
		public $type;
		public $value;
		public $operator;

		function __construct($name, $type, $value, $operator) {
			$this->name		= $name;
			$this->type 	= $type;
			$this->value 	= $value;
			$this->operator = $operator;
		}
	}


	//La funzione bool mysqli_stmt::bind_result ( mixed &$var1 [, mixed &$... ] ) necessita di parametri riferimento
	function ref_values($arr){
		$refs = array();
		foreach($arr as $key => $value) 
			$refs[$key] = &$arr[$key];
		return $refs;
	}


	//"Pulisce" i dati in input rimuovendo tutti i caratteri speciali
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
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


	function upload_file() {
		// per prima cosa verifico che il file sia stato effettivamente caricato
		if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
			echo 'Non hai inviato nessun file...';
			exit;    
		}
	
		global $uploaddir, $bongoDb;
		$size = $_FILES['file']['size'];
		$type = $_FILES['file']['type'];
		$tmp_name = $_FILES['file']['tmp_name'];
	
	
		//Recupero il percorso temporaneo del file
		$userfile_tmp = $_FILES['file']['tmp_name'];
	
		//recupero il nome originale del file caricato
		$userfile_name = $_FILES['file']['name'];
	
		$target_file = $uploaddir . $userfile_name;
	
		// Check if file already exists
		// if (file_exists($target_file)) {
		// 	$uploadError = "Sorry, file already exists.";
		// 	header("Location: index.php?uploadOk=" . $uploadError);
		// } 
	
		//copio il file dalla sua posizione temporanea alla mia cartella upload
		if (move_uploaded_file($userfile_tmp, $target_file)) {
			$location = $uploaddir.$userfile_name;
		
			$uid_img = uniqid("img_");	
		
			$query = "INSERT INTO `upload` (uidimg, name, size, type, location) VALUES (?, ?, ?, ?, ?)";
		
			$params = array($uid_img, $userfile_name, $size, $type, $location);
			$result = $bongoDb->performQueryWithParameters($query, "ssiss", $params);
			
			
		
			//Se l'operazione è andata a buon fine...
			return $uid_img;
		}else{
			//Se l'operazione è fallta...
			return null;
		}
	}
	
	function upload_base64file($img) {
		global $uploaddir, $bongoDb;

		$img = str_replace('data:image/jpeg;base64,', '', $img);
		$img = str_replace(' ', '+', $img);

		$data = base64_decode($img);

		$uid_img = uniqid("img_");

		$file_name = $uid_img . ".jpeg";

		$file = $uploaddir . $file_name;

		//Copio il file nella cartella upload
		$success = file_put_contents($file, $data);

		upload_img($uid_img, $file);
			
			

		//Se l'operazione è andata a buon fine...
		if($success) 
			return $uid_img;

		return null;

	}

	function get_filter() {
		//Creo un array contenente i filtri inseriti dall'utente
		$filter_values	 = array();
		if(!empty($_GET['title']))
			$filter_values[] = new filter_value('title', 's', "%{$_GET['title']}%", 'LIKE');
		if(!empty($_GET['category'])) {
			$len = count($_GET['category']);
			for($i = 0; $i < $len; $i++)
				$filter_values[] = new filter_value('category', 's', $_GET['category'][$i], '=');
		}				
		if(!empty($_GET['city']))				
			$filter_values[] = new filter_value('city', 's', $_GET['city'], '=');
		if(!empty($_GET['date'])) {
			if(!empty($_GET['time'])) {
				//Mostro soltanto gli eventi futuri
				$dateTime = strtotime($_GET['date'] . ' ' . $_GET['time']);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
			} else {
				$time = date("H:i:s", time());
				$dateTime = strtotime($_GET['date'] . ' ' . $time);
				$dateTime = date("Y-m-d H:i:s", $dateTime);
			}
			$filter_values[] = new filter_value('date', 's', $dateTime, '>=');
		} else {
			//Mostro soltanto gli eventi futuri
			$dateTime = date("Y-m-d H:i:s", time());
			$filter_values[] = new filter_value('date', 's', $dateTime, '>=');
		}

		return $filter_values;
	}
?>