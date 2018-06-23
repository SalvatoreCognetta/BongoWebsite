<?php

session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

include_once DIR_UTIL . 'sessionUtil.php';
include_once DIR_UTIL . 'utility.php';


	$id = $_GET['event'];
	print_r($_GET);
	// partecipate_event($id);
	// header("location: event_page.php?id=" . $id);


?>