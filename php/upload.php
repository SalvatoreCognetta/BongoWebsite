<?php
include 'connection.php';
include 'config.php';
// per prima cosa verifico che il file sia stato effettivamente caricato
if (!isset($_FILES['file']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
  echo 'Non hai inviato nessun file...';
  exit;    
}

$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];
$tmp_name = $_FILES['file']['tmp_name'];


//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['file']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['file']['name'];

//copio il file dalla sua posizione temporanea alla mia cartella upload
if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
  //Se l'operazione è andata a buon fine...
  echo 'File inviato con successo.';
  $location = $uploaddir.$userfile_name;
  $query = "INSERT INTO `upload` (name, size, type, location) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("siss",$userfile_name, $size, $type, $location);
  $stmt->execute();
  $result = $stmt->get_result();
}else{
  //Se l'operazione è fallta...
  echo 'Upload NON valido!'; 
}

?>