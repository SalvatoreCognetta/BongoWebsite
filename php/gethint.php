<?php 	

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbManager.php';
require_once DIR_UTIL . 'query.php';

$query = "SELECT nome FROM comuni";
$result = $bongoDb->performQuery($query); 
$i = 0;
while($row = $result->fetch_assoc() && $i==3) {
    $cities[] = htmlentities($row['nome']);
    ++$i;
}
echo json_encode("42");
?> 