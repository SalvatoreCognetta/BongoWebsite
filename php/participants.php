<?php
session_start();
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

require_once DIR_UTIL . "sessionUtil.php"; //includes session login
require_once DIR_UTIL . 'utility.php';

	$id = $_GET['id'];
	$participants = get_participants($id);
	while($row = $participants->fetch_assoc()) {
		$names[] = $row['fullname'];
	}
	
	echo json_encode($names);
	
?>