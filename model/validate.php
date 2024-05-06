<?php


/*
 * This will be used to validate form data from application/model
 * Make “First Name”, “Last Name”, “Email”, “Phone”, and “Years Experience” required fields. All other fields are optional,
   including GitHub URL and the jobs checkbox selections.

 * In your controller, require the validation file. When a form is submitted, validate the data in that form using the
   appropriate functions. If there are errors, display them inline in the form. (Be sure to add a style definition to
   your error messages so that they stand out.) If there are no errors, then store the data in the session array and
   display the next form.
 * So now create the validation methods for the forms
*/

function validName($name){
    $pattern = '/^[A-Za-z\s\-]+$/';
    return preg_match($pattern,$name);
}
function validGithub($link){
    $pattern = '~^https?://\S+$~';
    return preg_match($pattern,$link);
}
function validExperience($yearsInExperience){
    return in_array($yearsInExperience, getExperience());
}
function validPhone($phone){
    $pattern = '/^\d{3}-?\d{3}-?\d{4}$/';
    return (preg_match($pattern, $phone));
}

function validEmail($email){
    $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    return preg_match($pattern, $email);
}