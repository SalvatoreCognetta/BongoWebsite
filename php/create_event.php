<?php
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

include_once DIR_UTIL . 'sessionUtil.php';
include_once DIR_UTIL . 'utility.php';

//Controllo prima se l'utente è loggato
if (isLogged() == false) { 
	$err = "Devi essere loggato per creare un nuovo evento.";
	header("Location: ./create_event_page.php?err=" . $err);
}

$uid_img = upload_file();

// print_r($_POST);

$parameters[] =  uniqid("event_");

foreach($_POST as $key=>$field) {
	if($key === 'date') {
		$date = $field;
		continue;
	}

	if($key === 'time') {
		$time = $field;
		$dateTime = strtotime($date . ' ' . $time);
		$parameters[] = date("Y-m-d H:i:s", $dateTime);
		continue;
	}

	if($key === 'price-choice') {
		if($field === 'free') 
			$parameters[] = 0;
		else 
			$parameters[] = $_POST["ticket-price"];
		break;
	} else {
		if(!empty($field))
		$parameters[] = $field;
	}
}
$parameters[] = $uid_img;
$parameters[] = $_SESSION['userid'];

insert_event($parameters);

header("Location: ./event_page.php?id=" . $parameters[0]);


?>