<?php
session_start();
include 'connection.php';

$error=''; // Variable To Store Error Message

// if(empty($_SESSION)) {	
// 	$_SESSION['loggedin'] = false;	
// }

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username o Password non validi.";
	} else {
		// Define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "
			SELECT userid, username
			FROM user
			WHERE username = ? AND password = ?";
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ss",$username, $password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($row = $result->fetch_assoc()) {
			$_SESSION['userid'] = $row['userid'];
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
			header("Location: profile.php");
			exit();
		}else { 
			$error = "Username o Password invalidi.";
		}		 
	}
}
echo $error; 
?>
