<?php
session_start();

include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'utility.php';

$psw = array();

foreach($_POST as $key=>$field) {
	if($key == 'old-psw' || $key == 'new-psw')
		$psw[] = $field;
	else
		$params[] = $field;
}
update_user_info($_SESSION['userid'], $params);
// update_password($_SESSION['userid'], $psw);
header("Location: ./profile.php");
exit();
?>