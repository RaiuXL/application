<?php
// 328/pets/index.php
// Controller - MVC

// Turn on reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require autoload file
require('vendor/autoload.php');

//F3 base class
$F3 = Base::instance();

$F3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

$F3->run();