<?php
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

include_once DIR_UTIL . 'sessionUtil.php';
print_r($_FILES);
print_r($_POST);

if (isLogged() == false) { 
	$err = "Devi essere loggato per creare un nuovo evento.";
	header("Location: ./create_event_page.php?err=" . $err);
}


foreach($_POST as $key=>$field) {
	if($key === 'date') {
		$date = $field;
		continue;
	}

	if($key === 'time') {
		$time = $field;
		$dateTime = strtotime($date . ' ' . $time);
		$params[] = date("Y-m-d H:i:s", $dateTime);
		continue;
	}

	if($key === 'price-choice') {
		if($field === 'free') 
			$params[] = 0;
		else 
			$params[] = $_POST["ticket-price"];
		break;
	} else {
		if(!empty($field))
		$params[] = $field;
	}
}
$params[] = $_FILES['file']['name'];
print_r($params);
// insert_event($params);



?>