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

		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);

		$data = base64_decode($img);

		$file_name = uniqid("img_") . ".png";

		$file = $uploaddir . $file_name;

		//Copio il file nella cartella upload
		$success = file_put_contents($file, $data);

		upload_img($file_name, $file);
			
			

			//Se l'operazione è andata a buon fine...


		echo $success ? $file : 'Unable';

	}
?>