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
    /*var_dump($F3->get('SESSION'));*/
    $view = new Template();
    echo $view->render('views/info.html');
});

//experience route
$F3->route('GET|POST /experience', function($F3){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $bio = $_POST['bio'];
        $link = $_POST['link'];
        $yearsInExperience = $_POST['years-experience'];
        $willingToRelocate = $_POST['willing-to-relocate'];

        if(!empty($bio)&&!empty($link)&&!empty($yearsInExperience)&&!empty($willingToRelocate)){
            $F3->set('SESSION.bio',$bio);
            $F3->set('SESSION.link',$link);
            $F3->set('SESSION.years-experience',$yearsInExperience);
            $F3->set('SESSION.willing-to-relocate',$willingToRelocate);
            $F3->reroute("mailingList");
        } else {
            echo '<p>Error</p>';
        }
    }
    /*var_dump($F3->get('SESSION'));*/
    $view = new Template();
    echo $view->render('views/experience.html');
});

//mailing list route
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

//summary route
$F3->route('GET|POST /summary', function($F3){
    /*var_dump($F3->get('SESSION'));*/
    $view = new Template();
    echo $view->render('views/summary.html');
});
$F3->run();