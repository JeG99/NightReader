<?php
// Include Route class
require 'Controllers/Route.php';

Route::add('/',function(){
    $newURL = 'Views/home.php';
    include_once ($newURL);
});

Route::add('/home.php',function(){
    $newURL = 'Views/home.php';
    include_once ($newURL);
});

Route::add('/profile.php',function(){
    $newURL = 'Views/profile.php';
    include_once ($newURL);
});

Route::add('/search.php',function(){
    $newURL = 'Views/search.php';
    include_once ($newURL);
});

// Add login route
Route::add('/login.php',function(){
    if (!isset($_SESSION['id'])) {
        $newURL = 'Views/login.php';
        include_once ($newURL);        
    }
});

// Add signup route
Route::add('/signup.php',function(){
    $newURL = 'Views/signup.php';
    include_once ($newURL);
});

// Add login route
Route::add('/forgot.php',function(){
    $newURL = 'Views/forgot.php';
    include_once ($newURL);
});

// Add app route
Route::add('/book.php',function(){
    $newURL = 'Views/book.php';
    include_once ($newURL);
});

// Post route example
Route::add('/about.php',function(){
    $newURL = 'Views/about.php';
    include_once ($newURL);
});

Route::add('/logout.php',function(){
    session_start();
    session_unset();
    session_destroy();
    $newURL = 'Views/home.php';
    include_once ($newURL);
});

Route::run('/');
?>