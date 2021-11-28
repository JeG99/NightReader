<?php 

    require 'dbconn.php';
    require '../Models/poem.php';

    $q = $_GET["query"];
    $poem = new Poem($conn);
    $response = $poem->search($q, $_GET['id']);
    $arr = [];
    $arr = $response->fetchAll(); 
    echo json_encode($arr);
?>