<?php 
include_once __DIR__ . '/config.php';
include_once DIR_UTIL . 'utility.php';


if(!empty($_POST['title']))
	$filter_values[] = new filter_value('title', 's', $_POST['title'], null);
if(!empty($_POST['city']))
	$filter_values[] = new filter_value('city', 's', $_POST['city'], null);
if(!empty($_POST['date'])) {
	if(!empty($_POST['time'])) {
		//Mostro soltanto gli eventi futuri
		$dateTime = strtotime($_POST['date'] . ' ' . $_POST['time']);
		$dateTime = date("Y-m-d H:i:s", $dateTime);
	} else {
		$time = date("H:i:s", time());
		$dateTime = strtotime($_POST['date'] . ' ' . $time);
		$dateTime = date("Y-m-d H:i:s", $dateTime);
	}
	$filter_values[] = new filter_value('date', 's', $dateTime, null);
} else {
	//Mostro soltanto gli eventi futuri
	$dateTime = date("Y-m-d H:i:s", time());
	$filter_values[] = new filter_value('date', 's', $dateTime, null);
}
if(!empty($_POST['description']))
	$filter_values[] = new filter_value('description', 's', $_POST['description'], null);
if(!empty($_POST['categories']))
	$filter_values[] = new filter_value('category', 's', $_POST['categories'], null);
if(!empty($_POST['price-choice'])) {
	if($_POST['price-choice'] == 'free')
		$filter_values[] = new filter_value('price', 'd', 0, null);
	else
		$filter_values[] = new filter_value('price', 'd',$_POST['ticket-price'] , null);
}
if(!empty($_POST['hidden-img'])) {
	$uid_img = upload_base64file($_POST['hidden-img']);
	$filter_values[] = new filter_value('img', 's', $uid_img, null);
}


update_event($_POST['id'], $filter_values);



?>