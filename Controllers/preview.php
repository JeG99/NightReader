<?php 
    session_start();
    require 'dbconn.php';
    require '../Models/poem.php';

    $poem = new Poem($conn);
    $response = $poem->firstFive($_SESSION['id']);
    $arr = [];
    $arr = $response->fetchAll(); 
    echo json_encode($arr);
?>