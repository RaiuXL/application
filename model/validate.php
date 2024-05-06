<?php

function validName($name){
    $pattern = '/^[A-Za-z\s\-]+$/';
    return preg_match($pattern,$name);
}
function validLink($link){
    $pattern = '~^https?://\S+$~';
    return preg_match($pattern,$link);
}
function validExperience($yearsInExperience){
    return in_array($yearsInExperience, getExperience());
}
function getExperience()
{
    return array('0-2', '2-4', '4+');
}
function validPhone($phone){
    $pattern = '/^\d{3}-?\d{3}-?\d{4}$/';
    return (preg_match($pattern, $phone));
}

function validEmail($email){
    $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    return preg_match($pattern, $email);
}

function getJobOpenings()
{
    return array('JavaScript', 'HTML', 'PHP', 'CSS', 'Java', 'ReactJS', 'Python', 'NodeJS');
}

// Function to get industry verticals
function getIndustryVerticals()
{
    return array('SaaS', 'Industrial Tech', 'Health Tech', 'Cybersecurity', 'Ag Tech', 'HR Tech');
}