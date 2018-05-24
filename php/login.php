<?php
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbConfig.php';
require_once DIR_UTIL . "sessionUtil.php"; //includes session login
require_once DIR_UTIL . 'utility.php';

// Define $username and $password
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);


$error = login($username, $password); // Variable To Store Error Message

if($error === null)
	header('location: ./profile.php');
else
	header('location: ./index.php?error=' . $error );


function login($username, $password){   

	if ($username == null || $password == null) {
		return "Inserisci Username e Password.";
	} else {
		$userID = authenticate($username, $password);

		if($userID != -1) {
			session_start();
			setSession($username, $userID);
			return null;
		}
		 
	}

	return "Username o Password invalidi.";	

}

function authenticate ($username, $password){   
	global $conn;
	$username = $conn->real_escape_string($username);
	$password = $conn->real_escape_string($password);

	$query = "
			SELECT userid, username
			FROM user
			WHERE username = ? AND password = ?";

	$stmt = $conn->prepare($query);
	$stmt->bind_param("ss", $username, $password);
	$stmt->execute();
	$result = $stmt->get_result();


	$numRow = $result->num_rows;
	if ($numRow != 1)
		return -1;
	
	$userRow = $result->fetch_assoc();
	return $userRow['userid'];

	
		
}

?>
