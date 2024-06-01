<?php

require('model/data-layer.php');

function validName($name){
    $pattern = '/^[A-Za-z\s\-]+$/';
    return preg_match($pattern,$name);
}
function validBiography($bio) {
    $pattern = '/\w+/';
    return preg_match($pattern, $bio);
}

function validLink($link){
    $pattern = '~^https?://\S+$~';
    return preg_match($pattern,$link);
}
function validExperience($yearsInExperience){
    return in_array($yearsInExperience, getExperience());
}
function validRelocationOption($willingToRelocate){
    return in_array($willingToRelocate, getRelocationOptions());
}
function validPhone($phone){
    $pattern = '/^\d{3}-?\d{3}-?\d{4}$/';
    return (preg_match($pattern, $phone));
}

function validEmail($email){
    $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    return preg_match($pattern, $email);
}
