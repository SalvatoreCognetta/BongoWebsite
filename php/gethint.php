<?php 	

require_once __DIR__ . '/config.php';
require_once DIR_UTIL . 'dbConfig.php';

$query = "SELECT nome FROM comuni";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result(); 
$i = 0;
while($row = $result->fetch_assoc() && $i==3) {
    $cities[] = htmlentities($row['nome']);
    ++$i;
}
echo json_encode("42");
?> 