<?php
/*
  Author: Nathan Tapia-Ramirez
  Date: 4/14/23
  Description: Home page of application website.
*/

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

// personal information route
$F3->route('GET|POST /info', function($F3){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $state = $_POST['state'];
        $phone = $_POST['phone'];

        if(!empty($fname) && !empty($lname) && !empty($email) && !empty($state) && !empty($phone)) {
            echo "Message??";
            $F3->set('SESSION.fname',$fname);
            $F3->set('SESSION.lname',$lname);
            $F3->set('SESSION.email',$email);
            $F3->set('SESSION.state',$state);
            $F3->set('SESSION.phone',$phone);
            $F3->reroute("experience");
        } else{
            echo '<p>Error</p>';
        }
    }
    $view = new Template();
    echo $view->render('views/info.html');
});
//experience route
$F3->route('GET|POST /experience', function($F3){
    var_dump($F3->get('SESSION'));
    $view = new Template();
    echo $view->render('views/experience.html');
});
$F3->run();