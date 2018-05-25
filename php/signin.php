<?php
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
require_once DIR_UTIL . 'sessionUtil.php';
require_once DIR_UTIL . 'utility.php';

// Define $username and $password etc.
// define variables and set to empty values
$username = $password = $email = $emailConfirm = $fullname = null;
$error = null;

if (!empty($_POST["username"])) {
	$username = test_input($_POST["username"]);
} else {
	$error = "Username mancante";
}

if (!empty($_POST["password"])) {
	$password = test_input($_POST["password"]);
} else {
	$error = "Password mancante";
}

if (!empty($_POST["email"])) {
	$email = test_input($_POST["email"]);
} else {
	$error = "Email mancante";
}

if (!empty($_POST["email-confirm"])) {
	$emailConfirm = test_input($_POST["email-confirm"]);
}  else {
	$error = "Conferma email mancante";
}

if (!empty($_POST["fullname"])) {
	$fullname = test_input($_POST["fullname"]);
} else {
	$error = "Nome mancante";
}

if($error === null)
	$error = signin($username, $password, $fullname, $email, $emailConfirm); // Variable To Store Error Message

if($error === null)
	header('location: ./profile.php');
else
	header('location: ./index.php?error=' . $error);


function signin($username, $password, $fullname, $email, $emailConfirm) {
	if ($fullname == null || $username == null || $email == null|| $emailConfirm == null|| $password == null) {
		return "Dati mancanti.";
	} else {
		if($email !== $emailConfirm) {
			return "Le mail inserite non coincidono!";
		}

		$err = isValid($fullname, $username, $email);
		if($err === null) {
			global $bongoDb;
			$username = $bongoDb->sqlInjectionFilter($username);
			$password = $bongoDb->sqlInjectionFilter($password);
			$userid = uniqid("user_");
			
			$query = "INSERT INTO user (`userid`, `username`, `email`, `fullname`, `password`) VALUES (?, ?, ?, ?, ?);";
			
			$params = array($userid, $username, $email, $fullname, $password);
			$result = $bondoDb->performQueryWithParameters($query, "sssss", $params);
	
			session_start();
			setSession($username, $userid);
			return null;	
		}
	}
	return $err;
	
}

function isValid($fullname, $username, $email){
	//Controllo se i dati inseriti sono validi
	if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
		return "Only letters and white space allowed";
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return "Invalid email format";
	}
	
	//Controllo se c'è già un utente registrato con quella mail e/o username	
	global $bongoDb;
	$username = $bongoDb->sqlInjectionFilter($username);
	$email = $bongoDb->sqlInjectionFilter($email);

	$query = "
		SELECT *
		FROM user
		WHERE username = ? OR email = ?";
	
	$params = array($username, $email);
	$result = $bondoDb->performQueryWithParameters($query, "ss", $params);
	$numRow = $result->num_rows;

	if($numRow == 0)
		return null;

	$row = $result->fetch_assoc();

	if($row['username'] == $username) {
		return  "Username già utilizzato. ";
	}

	if($row['email'] == $email) {
		return  "Email già utilizzata. ";
	}
}




















// if (isset($_POST['submit'])) {
// 	if ( fullname']) || username']) || email']) || email-confirm']) || password']) ) {
// 		$error = "Dati mancanti.";

// 		// echo $_POST['fullname'];
// 		// echo $_POST['username'];
// 		// echo $_POST['email'];
// 		// echo $_POST['email-confirm'];
		
// 	} else {
// 		$userid = uniqid("user_");
// 		$fullname = $_POST['fullname'];
// 		$username = $_POST['username'];
// 		$email =  $_POST['email'];
// 		$password = $_POST['password'];
		
// 		$query = "
// 			SELECT username, email
// 			FROM user
// 			WHERE username = ? OR email = ?";
		
// 		$stmt = $bongoDb->conn->prepare($query);
// 		$stmt->bind_param("ss",$username, $email);
// 		$stmt->execute();
// 		$result = $stmt->get_result();
		
// 		$match = false;
		
// 		while($row = $result->fetch_assoc()) {
// 			print_r($row);
// 			if($row['username'] == $username) {
// 				$error .= "Username già utilizzato. ";
// 				$match = true;
// 			}

// 			if($row['email'] == $email) {
// 				$error .= "Email già utilizzata. ";
// 				$match = true;
// 			}
// 		}

// 		if(!$match) {
// 			$query = "INSERT INTO user (`userid`, `username`, `email`, `fullname`, `password`) VALUES (?, ?, ?, ?, ?);";
// 			$stmt = $bongoDb->conn->prepare($query);
// 			$stmt->bind_param("sssss",$userid, $username, $email, $fullname, $password);
// 			$stmt->execute();
	
// 			$query = "
// 			SELECT userid, username
// 			FROM user
// 			WHERE username = ? AND password = ?";
		
// 			$stmt = $bongoDb->conn->prepare($query);
// 			$stmt->bind_param("ss",$username, $password);
// 			$stmt->execute();
// 			$result = $stmt->get_result();
// 			if($row = $result->fetch_assoc()) {
// 				set_session($username, $row['userid']);				
// 				header("Location: profile.php");
// 				exit();
// 			} else {
// 				echo "error";
// 			}
			
// 		} else {
// 			header("Location: index.php");
// 			exit();
// 		}	 
// 	}
// 	echo $error;
// } 
// 
?>
