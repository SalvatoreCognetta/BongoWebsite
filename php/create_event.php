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

// $uid_img = upload_file();
if(!empty($_POST['hidden-img'])){
	$uid_img = upload_base64file($_POST['hidden-img']);
	echo $uid_img;
	$id_event = uniqid("event_");

	$parameters[] =  $id_event;

	foreach($_POST as $key=>$field) {
		if(!empty($_POST[$key])){
			if($key === 'hidden-img')
				continue;
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
	}
	$parameters[] = $uid_img;
	insert_event($_SESSION['userid'], $parameters);


	partecipate_event($_SESSION['userid'], $id_event);

	header("Location: ./event_page.php?id=" . $id_event);
} else {
	$err = "Inserire un\'immagine";
	header("Location: ./create_event_page.php?err=" . $err);
}

// print_r($_POST);



?>