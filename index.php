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
require('model/validate.php');


$F3 = Base::instance();

// Default Route
$F3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

// Summary route 4/4
// Can't get the checkboxes to display selected data
$F3->route('GET|POST /summary', function($F3){
    var_dump($F3->get('SESSION'));
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Information route 1/4
$F3->route('GET|POST /info', function($F3){

    if($_SERVER['REQUEST_METHOD']=='POST'){

        if (isset($_POST['fname']) and validName($_POST['fname'])) {
            $fname = $_POST['fname'];
        }
        else {
            $F3->set('errors["fname"]', 'Please enter a first name');
        }

        if (isset($_POST['lname']) and validName($_POST['lname'])) {
            $lname = $_POST['lname'];
        }
        else {
            $F3->set('errors["lname"]', 'Please enter a last name');
        }

        if (isset($_POST['email']) and validEmail($_POST['email'])) {
            $email = $_POST['email'];
        }
        else {
            $F3->set('errors["email"]', 'Please enter an email');
        }

        if (isset($_POST['phone']) and validPhone($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
        else {
            $F3->set('errors["phone"]', 'Please enter a phone number');
        }

        $state = $_POST['state'];

        $F3->set('SESSION.fname',$fname);
        $F3->set('SESSION.lname',$lname);
        $F3->set('SESSION.email',$email);
        $F3->set('SESSION.state',$state);
        $F3->set('SESSION.phone',$phone);


        if(empty($F3->get('errors'))) {
            $F3->reroute('experience');
        }
    }

    $view = new Template();
    echo $view->render('views/info.html');
});

// Experience route 2/4
$F3->route('GET|POST /experience', function($F3){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $bio = $_POST['bio'];
        $link = $_POST['link'];
        $yearsInExperience = $_POST['yearsInExperience'];
        $willingToRelocate = $_POST['willingToRelocate']; // Corrected variable name

        if(!empty($bio)&&!empty($link)&&!empty($yearsInExperience)&&!empty($willingToRelocate)){
            $F3->set('SESSION.bio',$bio);
            $F3->set('SESSION.link',$link);
            $F3->set('SESSION.yearsInExperience',$yearsInExperience);
            $F3->set('SESSION.willingToRelocate',$willingToRelocate); // Corrected session key
            $F3->reroute("mailingList");
        }
    }
    $view = new Template();
    echo $view->render('views/experience.html');
});

//  Mailing List Route 3/4
$F3->route('GET|POST /mailingList', function($F3){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // Initialize an array to store selected checkboxes
        $selectedCheckboxes = [];

        // Checkboxes for Software Development Jobs
        if(isset($_POST['JavaScript'])) {
            $selectedCheckboxes[] = $_POST['JavaScript'];
        }
        if(isset($_POST['HTML'])) {
            $selectedCheckboxes[] = $_POST['HTML'];
        }
        if(isset($_POST['PHP'])) {
            $selectedCheckboxes[] = $_POST['PHP'];
        }
        if(isset($_POST['CSS'])) {
            $selectedCheckboxes[] = $_POST['CSS'];
        }
        if(isset($_POST['Java'])) {
            $selectedCheckboxes[] = $_POST['Java'];
        }
        if(isset($_POST['ReactJS'])) {
            $selectedCheckboxes[] = $_POST['ReactJS'];
        }
        if(isset($_POST['Python'])) {
            $selectedCheckboxes[] = $_POST['Python'];
        }
        if(isset($_POST['NodeJS'])) {
            $selectedCheckboxes[] = $_POST['NodeJS'];
        }

        // Checkboxes for Industry Verticals
        if(isset($_POST['SaaS'])) {
            $selectedCheckboxes[] = $_POST['SaaS'];
        }
        if(isset($_POST['Industrial_Tech'])) {
            $selectedCheckboxes[] = $_POST['Industrial_Tech'];
        }
        if(isset($_POST['Health_Tech'])) {
            $selectedCheckboxes[] = $_POST['Health_Tech'];
        }
        if(isset($_POST['Cybersecurity'])) {
            $selectedCheckboxes[] = $_POST['Cybersecurity'];
        }
        if(isset($_POST['Ag_Tech'])) {
            $selectedCheckboxes[] = $_POST['Ag_Tech'];
        }
        if(isset($_POST['HR_Tech'])) {
            $selectedCheckboxes[] = $_POST['HR_Tech'];
        }

        // Save the selected checkboxes to session
        $F3->set('SESSION.selectedCheckboxes', $selectedCheckboxes);

        // Redirect to the next page
        $F3->reroute("summary");
    }

    $view = new Template();
    echo $view->render('views/mailingList.html');
});

$F3->run();