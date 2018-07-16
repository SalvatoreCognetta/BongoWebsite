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
	$password = password_hash(test_input($_POST["password"]), PASSWORD_BCRYPT);
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
	header('location: ./index.php?err=' . $error);


function signin($username, $password, $fullname, $email, $emailConfirm) {
	if ($fullname == null || $username == null || $email == null|| $emailConfirm == null|| $password == null) {
		return "Dati mancanti.";
	} else {
		if($email !== $emailConfirm) {
			return "Le mail inserite non coincidono!";
		}

		$err = isValid($fullname, $username, $email);
		if($err === null) {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$params = array($username, $email, $fullname, $password);


			$userid = create_user($username, $email, $fullname, $password);
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

	$result =  user_already_exist($username, $email);

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













?>
