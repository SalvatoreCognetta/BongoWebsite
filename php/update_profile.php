<?php
session_start();

include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'utility.php';


foreach($_POST as $key=>$field) {
		$params[] = $field;
}
update_user_info($_SESSION['userid'], $params);

header("Location: ./profile.php");
exit();
?>