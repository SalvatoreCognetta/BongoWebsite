<?php 
	//DataBase config info
	$dbHostname	= "localhost";
	$dbUsername	= "root";
	$dbPassword 	= "";
	$dbName 	= "eventi_bongo";

	// Create connection
	$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	//Event table
	$event_table_name = 'evento';
	$idcol 		= 'idevent';
	$imgcol		= 'img';
	$titlecol 	= 'title';
	$descol 	= 'description';
	$datecol  	= 'date';
	$pricecol	= 'price';
	$numcol		= 'numParticipants';
	$citycol	= 'city';
	$catcol		= 'category';
	
?>