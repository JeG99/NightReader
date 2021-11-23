<?php
	include "dbconn.php";
	require '../Models/user.php';

	$user = new User($conn);
	$user->setFirstName($_POST['fname']);
	$user->setLastName($_POST['lname']);
	$user->setUsername($_POST['username']);
	$user->setEmail($_POST['email']);
	$user->setPassword(sha1($_POST['password']));

	if($user->signup()) {
		echo "1";
	}
	else {
		echo "2";	
	}
	$conn = null;
?>