<?php
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';


$event = get_event($_GET['idevent']);

echo $event['price'];
?>