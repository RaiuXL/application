<?php
/*
  Author: Nathan Tapia-Ramirez
  Date: 4/14/23
  Description: Home page of application website.
*/

// Turn on reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

require('vendor/autoload.php');

$F3 = Base::instance();
$con = new Controller($F3);

// Default Route
$F3->route('GET /', function(){
    $GLOBALS['con']->home();
});

// Summary route 4/4
$F3->route('GET|POST /summary', function(){
    $GLOBALS['con']->summary();
});

// Information route 1/4
$F3->route('GET|POST /info', function(){
    $GLOBALS['con']->information();
});

// Experience route 2/4
$F3->route('GET|POST /experience', function(){
    $GLOBALS['con']->experience();
});

//  Mailing List Route 3/4
$F3->route('GET|POST /mailingList', function(){
    $GLOBALS['con']->mailingList();
});

$F3->route('POST /upload', function() {
    $GLOBALS['con']->handleFileUpload();
});

$F3->run();