<?php 
session_start();

include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'utility.php';


if(authenticate($_SESSION['username'], $_POST['old-psw']) != -1) {
	update_psw($_SESSION['userid'], password_hash($_POST['new-psw'], PASSWORD_BCRYPT));
	header("Location: profile.php?success=1");
	echo "success";
}else
header("Location: profile.php?success=0");

?>