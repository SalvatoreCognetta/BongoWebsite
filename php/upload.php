<?php
session_start();

include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';
include_once DIR_UTIL . 'utility.php';

$uid_img = upload_file();

update_avatar($_SESSION['userid'], $uid_img);

header("Location: ./profile.php");
exit();

?>