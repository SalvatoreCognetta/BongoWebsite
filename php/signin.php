<?php
session_start();
include 'connection.php';

$error=''; // Variable To Store Error Message

// if(empty($_SESSION)) {	
// 	$_SESSION['loggedin'] = false;	
// }

if (isset($_POST['submit'])) {
	if ( empty($_POST['fullname']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['email-confirm']) || empty($_POST['password']) ) {
		$error = "Dati mancanti.";

		// echo $_POST['fullname'];
		// echo $_POST['username'];
		// echo $_POST['email'];
		// echo $_POST['email-confirm'];
		
	} else {
		$userid = uniqid("user_");
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email =  $_POST['email'];
		$password = $_POST['password'];
		
		$query = "
			SELECT username, email
			FROM user
			WHERE username = ? OR email = ?";
		
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ss",$username, $email);
		$stmt->execute();
		$result = $stmt->get_result();
		
		$match = false;
		
		while($row = $result->fetch_assoc()) {
			print_r($row);
			if($row['username'] == $username) {
				$error .= "Username già utilizzato. ";
				$match = true;
			}

			if($row['email'] == $email) {
				$error .= "Email già utilizzata. ";
				$match = true;
			}
		}

		if(!$match) {
			$query = "INSERT INTO user (`userid`, `username`, `email`, `fullname`, `password`) VALUES (?, ?, ?, ?, ?);";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("sssss",$userid, $username, $email, $fullname, $password);
			$stmt->execute();
	
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
			} else {
				echo "error";
			}
			
		} else {
			header("Location: home.php");
			exit();
		}	 
	}
	echo $error;
} 
?>
