<?php 
require_once __DIR__ . "/../config.php";
require DIR_UTIL . "dbConfig.php"; 			// includes database class
require_once DIR_UTIL . "utility.php";

$bongoDb = new BongoDbManager(); // creates a new istance of Database Class


class BongoDbManager {
	private $conn = null;

	function BongoDbManager() {
		$this->openConnection();
	}

	function openConnection() {
		if (!$this->isOpened()){
			global $dbHostname;
			global $dbUsername;
			global $dbPassword;
			global $dbName;
			
			// Create connection			
			$this->conn = new mysqli($dbHostname, $dbUsername, $dbPassword);
			if ($this->conn->connect_error) 
				die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
			// Check connection
			$this->conn->select_db($dbName) or
				die ('Can\'t use pweb: ' . mysqli_error());

		}
	}

	//Check if the connection to the database id opened
	function isOpened() {
		   return ($this->conn != null);
	}

	// Executes a query with prepared statement and returns the results
	function performQuery($queryText) {
		if (!$this->isOpened())
			$this->openConnection();
		
					
		/* activate reporting */
		$driver = new mysqli_driver();
		$driver->report_mode = MYSQLI_REPORT_ERROR;

		try {
			//Preparo il template dello statement sql		
			if($stmt = $this->conn->prepare($queryText))  {
				//Eseguo la query	
				if(!$stmt->execute()) {
					// echo("Error description: " . $stmt->error); 
					return  null;
				}
				//Ottengo i risultati della query		
				$result = $stmt->get_result(); 
				return $result;
			} else {
				// echo htmlspecialchars($this->conn->error);
				return null;
			}
		} catch (mysqli_sql_exception $e) {
			echo $e->__toString();
		}
		
	}

	// Executes a query with prepared statement and returns the results
	// In questo caso abbiamo anche dei parametri da inserire nella query. L'overloading dei metodi in php non è possibile quindi ho dato un altro nome alla funzione
	function performQueryWithParameters($queryText, $parameters_type, $parameters) {  //La variabile parameters è un array contenente tutti i parametri da inserire nella query, mentre parameters_type è una stringa contenente i tipi (stringa, int, etc.) dei parametri
		if (!$this->isOpened())
			$this->openConnection();
		if(count($parameters) != strlen(utf8_decode($parameters_type))) {
			$error = "Errore nella query, il numero di parametri non coincidono con il numero di tipi inseriti.";
			header("Location: index.php?err=" . $error);
		}
		
		try {

			//Preparo il template dello statement sql
			if($stmt = $this->conn->prepare($queryText)) {
					
				$bind_params[0] = $parameters_type;
				if(count($parameters) == 1 && gettype($parameters) == "string") { //Per evitare che parameters venga considerato un'array di caratteri dentro il ciclo for.
					$bind_params[] = $parameters;
				} else {
					for ($i = 0; $i < count($parameters); $i++) {
						$bind_params[] = $parameters[$i];
					}
				}
				
				// echo "Perform query: ". $queryText . '\n';
				// print_r($bind_params);
				// echo '\n';
				//Call di un metodo all'interno di una classe: call_user_func(array('MyClass', 'myCallbackMethod'))
				/*In programmazione, un callback (o, in italiano, richiamo) è, in genere, una funzione, o un "blocco di codice" che viene passata come parametro ad un'altra funzione. In particolare, quando ci si riferisce alla callback richiamata da una funzione, la callback viene passata come argomento ad un parametro della funzione chiamante. In questo modo la chiamante può realizzare un compito specifico (quello svolto dalla callback) che non è, molto spesso, noto al momento della scrittura del codice. [Wikipedia]*/
				call_user_func_array(array($stmt, "bind_param"), ref_values($bind_params)); 

				//Eseguo la query		
				if(!$stmt->execute()) {
					 echo "Error description: " . $stmt->error; 
					return  null;
				}

				//Ottengo i risultati della query		
				$result = $stmt->get_result(); 
				return $result;
			} else {
				echo htmlspecialchars($this->conn->error);
				return null;
			} 
		} catch (mysqli_sql_exception $e) {
			echo $e->__toString();
		}
		
	}	
	
	function sqlInjectionFilter($parameter) {
		if(!$this->isOpened())
			$this->openConnection();
			
		return $this->conn->real_escape_string($parameter);
	}


	public function __destruct() {
		//Close the connection
		if($this->conn !== null)
		$this->conn->close();
		
		$this->conn = null;
	}
}



?>