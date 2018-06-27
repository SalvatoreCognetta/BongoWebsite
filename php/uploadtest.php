<?php

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';

upload_base64file($_POST['hidden-img']);
// header('Location: '.$_POST['return_url']);


?>