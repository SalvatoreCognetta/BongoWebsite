<?php
$query = $_GET['query'];

//Legge un file intero come stringa		
$str = file_get_contents('../js/comuni.json');
$json = json_decode($str, true);
foreach($json as $key => $value) {
	$comuni[] = $value['nome'];
}

$hint = array();
if ($query) {
	$len = strlen($query);
    foreach ($comuni as $key => $value) {
        if (stristr($query, substr($value, 0, $len))) 
            $hint[] = $value;
		
    }
}

echo json_encode(array_values($hint));
?>