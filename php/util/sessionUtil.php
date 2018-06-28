<?php
	
	//setSession: set $_SESSION properly
	function setSession($username, $userid){
		$_SESSION['userid'] = $userid;
		$_SESSION['username'] = $username;
	}

	//isLogged: check if user has logged in and, if it is the case, returns the username
	function isLogged(){	
		if(isset($_SESSION['userid']))
			return $_SESSION['userid'];
		else
			return false;
	}

?>