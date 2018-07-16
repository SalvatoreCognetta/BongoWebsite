<?php 
require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';


$img_location = get_event_img_location($_GET['idevent']);

echo $img_location;

?>