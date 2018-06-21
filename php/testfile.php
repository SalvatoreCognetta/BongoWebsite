<?php 
session_start();

include __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

print_r($_FILES);
print_r($_POST);

?>