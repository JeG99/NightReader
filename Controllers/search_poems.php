<?php 

    require 'dbconn.php';
    require '../Models/poem.php';

    $q = $_GET["query"];
    //var_dump($q);
    $poem = new Poem($conn);
    $response = $poem->search($q);
    $arr = [];
    $arr = $response->fetchAll(); 
    echo json_encode($arr);
?>