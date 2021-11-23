<?php
// Include Route class
require 'Controllers/Route.php';

// Add base route (startpage)
Route::add('/',function(){
    $newURL = 'Views/home.html';
    header('Location: '. $newURL);
});

// Add login route
Route::add('/login',function(){
    $newURL = 'Views/login.html';
    header('Location: '. $newURL);
});

// Add signup route
Route::add('/signup',function(){
    $newURL = 'Views/signup.html';
    header('Location: '. $newURL);
});

// Add login route
Route::add('/forgot',function(){
    $newURL = 'Views/forgot.html';
    header('Location: '. $newURL);
});

// Add app route
Route::add('/nightread',function(){
    $newURL = 'Views/book.html';
    header('Location: '. $newURL);
});

// Post route example
Route::add('/about',function(){
    $newURL = 'Views/about.html';
    header('Location: '. $newURL);
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