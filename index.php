<?php
// Include Route class
require 'Controllers/Route.php';

// Add base route (startpage)
Route::add('/',function(){
    //echo '<script>console.log(' . $_SESSION['id'] . ');</script>';
    $newURL = 'Views/home.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

Route::add('/home.php',function(){
    $newURL = 'Views/home.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

Route::add('/profile.php',function(){
    $newURL = 'Views/profile.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

Route::add('/search.php',function(){
    $newURL = 'Views/search.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

// Add login route
Route::add('/login.php',function(){
    if (!isset($_SESSION['id'])) {
        //echo '<script>console.log(' . $_SESSION['id'] . ');</script>';
        //session_start();
        $newURL = 'Views/login.php';
        include_once ($newURL);        
    }
    //header('Location: '. $newURL);
});

// Add signup route
Route::add('/signup.php',function(){
    $newURL = 'Views/signup.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

// Add login route
Route::add('/forgot.php',function(){
    $newURL = 'Views/forgot.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

// Add app route
Route::add('/book.php',function(){
    //if (!isset($_SESSION['id'])) {
    //    session_start(); 
    //}
    $newURL = 'Views/book.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

// Post route example
Route::add('/about.php',function(){
    $newURL = 'Views/about.php';
    include_once ($newURL);
    //header('Location: '. $newURL);
});

Route::add('/logout.php',function(){
    session_start();
    session_unset();
    session_destroy();
    $newURL = 'Views/home.php';
    include_once ($newURL);
});

// Get route example
Route::add('/contact',function(){
    echo '
    <form method="post">
        <input type="text" name="contact" />
        <input type="submit" value="send" />
    </form>';
},'get');

// Post route example
Route::add('/contact',function(){
    echo 'Contact:<br/>';
    print_r($_POST);
},'post');

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/user/([0-9]*)/([a-zA-Z0-9]*)',function($var1, $var2){
    include_once ('getter.php');
});

//echo "indexecho";
Route::run('/');
?>