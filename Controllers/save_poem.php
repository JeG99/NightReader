<?php 
    session_start();
    require 'dbconn.php';
    require '../Models/poem.php';
    $poem = new Poem($conn);

    $poem->setTitle($_POST['title']);
    $poem->setContent($_POST['content']);
    $poem->setUrl($_POST['url']);
    $poem->setPoetName($_POST['poet']['name']);
    $poem->setPoetUrl($_POST['poet']['url']);
    
    if(isset($_SESSION['id'])) {
        //var_dump($_SESSION);
        if($poem->save($_SESSION['id'])) {
            echo 'Se hizo';
        }
    } else {
        echo 'No se hizo';
    }

?>