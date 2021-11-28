<?php
	include "dbconn.php";
	require '../Models/user.php';
    session_start();
	
	$user = new User($conn);
	$user->setUid($_SESSION['id']);

	if($user->delete()) {
		session_unset();
		session_destroy();
		echo "1";
	}
	else {
		echo "2";
	}
	$conn = null;

?>