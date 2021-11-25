<?php
	//include "dbconn.php";
	require '../Models/poem.php';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://www.poemist.com/api/v1/randompoems");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	var_dump($output);
	curl_close($curl);

?>