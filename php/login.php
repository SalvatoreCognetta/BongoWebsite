<?php
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

require_once DIR_UTIL . "sessionUtil.php"; //includes session login
require_once DIR_UTIL . 'utility.php';

// Define $username and $password
$username = test_input($_POST["username"]);
$password = test_input($_POST["password"]);


$error = login($username, $password); // Variable To Store Error Message
// print_r($_SESSION);

if($error === null)
	header('location: ./profile.php');
else
	header('location: ./index.php?err=' . $error );


function login($username, $password){   

	if ($username == null || $password == null) {
		return "Inserisci Username e Password.";
	} else {
		echo $password.$username;
		$userID = authenticate($username, $password);

		if($userID != -1) {
			setSession($username, $userID);
			return null;
		}
		 
	}

	return "Username o Password invalidi.";	

}



?>
