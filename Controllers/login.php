<?php 
	require '../Models/user.php';
	require 'dbconn.php';

	$user = new User($conn);
	$user->setEmail($_POST['email']);
	$user->setPassword(sha1($_POST['password']));
	echo $user->login();
	$conn = null;
?>