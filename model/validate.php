<?php

require('model/data-layer.php');

/**
 * Validate a name.
 *
 * @param string $name
 * @return bool
 */
function validName($name){
    $pattern = '/^[A-Za-z\s\-]+$/';
    return preg_match($pattern,$name);
}

/**
 * Validate a biography.
 *
 * @param string $bio
 * @return bool
 */
function validBiography($bio) {
    $pattern = '/\w+/';
    return preg_match($pattern, $bio);
}

/**
 * Validate a link.
 *
 * @param string $link
 * @return bool
 */
function validLink($link){
    $pattern = '~^https?://\S+$~';
    return preg_match($pattern,$link);
}

/**
 * Validate years of experience.
 *
 * @param string $yearsInExperience
 * @return bool
 */
function validExperience($yearsInExperience){
    return in_array($yearsInExperience, getExperience());
}

/**
 * Validate relocation option.
 *
 * @param string $willingToRelocate
 * @return bool
 */
function validRelocationOption($willingToRelocate){
    return in_array($willingToRelocate, getRelocationOptions());
}

/**
 * Validate a phone number.
 *
 * @param string $phone
 * @return bool
 */
function validPhone($phone){
    $pattern = '/^\d{3}-?\d{3}-?\d{4}$/';
    return (preg_match($pattern, $phone));
}

/**
 * Validate an email address.
 *
 * @param string $email
 * @return bool
 */
function validEmail($email){
    $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    return preg_match($pattern, $email);
}
