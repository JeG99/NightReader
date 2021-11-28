<?php 
	require '../Models/user.php';
	require 'dbconn.php';

	$user = new User($conn);
	$user->setEmail($_POST['email']);
	$user->setPassword(sha1($_POST['password']));
	$auth = $user->login(); 
	
	echo $auth;

	$conn = null;
?>