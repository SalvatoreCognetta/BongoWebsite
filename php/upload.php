<?php
session_start();

include_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
  echo 'Non hai inviato nessun file...';
  exit;    
}

global $uploaddir;
$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']['tmp_name'];


//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['file']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['file']['name'];

$target_file = $uploaddir . $userfile_name;

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
  header("Location: index.php?uploadOk=" . $uploadOk);
} 

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $target_file)) {
  $location = $uploaddir.$userfile_name;

	$uid = uniqid("img_");	

  $query = "INSERT INTO `upload` (uidimg, name, size, type, location) VALUES (?, ?, ?, ?, ?)";

  $params = array($uid, $userfile_name, $size, $type, $location);
  $result = $bongoDb->performQueryWithParameters($query, "ssiss", $params);
  

  //Questa porzione di codice deve essere eseguita solo per l'aggiornamento dell'immagine del profilo!!!
  $userid = $_SESSION['userid'];
  
  $query = "UPDATE user SET idavatar = '$uid' WHERE userid = '$userid'";
  $result = $bongoDb->performQuery($query);

	//Se l'operazione è andata a buon fine...
  echo 'File inviato con successo.';
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}

header("Location: ./profile.php");
exit();

?>