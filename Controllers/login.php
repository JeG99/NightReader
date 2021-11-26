<?php 
	require '../Models/user.php';
	require 'dbconn.php';

	$user = new User($conn);
	$user->setEmail($_POST['email']);
	$user->setPassword(sha1($_POST['password']));
	$auth = $user->login(); 
	/*if($auth == 1) {
		session_start();
		$_SESSION['id'] = $user->getUid();
		$_SESSION['fname'] = $user->getFirstName();
		$_SESSION['lname'] = $user->getLastName();
		$_SESSION['username'] = $user->getUsername();
		$_SESSION['email'] = $user->getEmail();
	}*/
	
	//if (isset($_SESSION['id'])) {
	echo $auth;
	//}

	//echo var_dump($_SESSION);
	$conn = null;
?>