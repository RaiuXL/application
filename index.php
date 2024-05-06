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
$F3->route('GET|POST /summary', function(){

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

        $willingToRelocate = $_POST['willingToRelocate'];

        if (isset($_POST['link']) and validLink($_POST['link'])) {
            $link = $_POST['link'];
        }
        else {
            $F3->set('errors["link"]', 'Please enter a valid URL');
        }

        if (isset($_POST['yearsInExperience']) and validExperience($_POST['yearsInExperience'])) {
            $yearsInExperience = $_POST['yearsInExperience'];
        }
        else {
            $F3->set('errors["yearsInExperience"]', 'Please select years of experience');
        }

        $bio = $_POST['bio'];

        $F3->set('SESSION.bio',$bio);
        $F3->set('SESSION.link',$link);
        $F3->set('SESSION.yearsInExperience',$yearsInExperience);
        $F3->set('SESSION.willingToRelocate',$willingToRelocate);

        if(empty($F3->get('errors'))) {
            $F3->reroute('mailingList');
        }
    }

    $view = new Template();
    echo $view->render('views/experience.html');
});

//  Mailing List Route 3/4
$F3->route('GET|POST /mailingList', function($F3){

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $selectedCheckboxes = [];

        // Check for selected job openings
        foreach(getJobOpenings() as $job){
            if(isset($_POST['jobOpenings']) && in_array($job, $_POST['jobOpenings'])){
                $selectedCheckboxes[] = $job;
            }
        }

        // Check for selected industry verticals
        foreach(getIndustryVerticals() as $vertical){
            if(isset($_POST['industryVerticals']) && in_array($vertical, $_POST['industryVerticals'])){
                $selectedCheckboxes[] = $vertical;
            }
        }

        // Save the selected checkboxes to session
        $F3->set('SESSION.selectedCheckboxes', $selectedCheckboxes);

        // Redirect to the next page
        $F3->reroute("summary");
    }
    $jobOpenings = getJobOpenings();

    // Checkboxes for Industry Verticals
    $industryVerticals = getIndustryVerticals();

    // Save the selected checkboxes to session
    $F3->set('jobOpenings', $jobOpenings);
    $F3->set('industryVerticals', $industryVerticals);

    $view = new Template();
    echo $view->render('views/mailingList.html');
});

$F3->run();