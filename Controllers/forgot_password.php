<?php 
	require '../Models/user.php';
	require 'dbconn.php';

	$user = new User($conn);

	if($_POST['password1'] === $_POST['password2']) {
		$user->setEmail($_POST['email']);
		$user->setPassword(sha1($_POST['password1']));		
		
		if($user->changepass()) {
			echo "1";
		} /*
		else {
			echo "There was a problem changing the password.";
		} */
		
	}
	else {
		echo "2";
	}

	$conn = null;
?>