<?php

/**
 * Class Applicant
 *
 * This class represents an applicant.
 */
class Applicant {
    private $_fname;
    private $_lname;
    private $_email;
    private $_state;
    private $_phone;
    private $_link;
    private $_experience;
    private $_relocate;
    private $_bio;

    /**
     * Constructor
     *
     * @param $_fname
     * @param $_lname
     * @param $_email
     * @param $_state
     * @param $_phone
     * @param $_link
     * @param $_experience
     * @param $_relocate
     * @param $_bio
     */
    public function __construct($_fname, $_lname, $_email, $_state, $_phone, $_link, $_experience, $_relocate, $_bio)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
        $this->_state = $_state;
        $this->_phone = $_phone;
        $this->_link = $_link;
        $this->_experience = $_experience;
        $this->_relocate = $_relocate;
        $this->_bio = $_bio;
    }

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Set the first name.
     *
     * @param string $fname
     * @return void
     */
    public function setFname($fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * Get the last name.
     *
     * @return string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Set the last name.
     *
     * @param string $lname
     * @return void
     */
    public function setLname($lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * Get the email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set the email.
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * Get the state.
     *
     * @return string
     */
    public function getState()
    {
        return $this->_state;
    }


    /**
     * Set the state.
     *
     * @param string $state
     * @return void
     */
    public function setState($state): void
    {
        $this->_state = $state;
    }

    /**
     * Get the phone number.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set the phone number.
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * Get the LinkedIn link.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * Set the LinkedIn link.
     *
     * @param string $link
     * @return void
     */
    public function setLink($link): void
    {
        $this->_link = $link;
    }

    /**
     * Get the experience.
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->_experience;
    }

    /**
     * Set the experience.
     *
     * @param string $experience
     * @return void
     */
    public function setExperience($experience): void
    {
        $this->_experience = $experience;
    }

    /**
     * Get the relocation preference.
     *
     * @return string
     */
    public function getRelocate()
    {
        return $this->_relocate;
    }

    /**
     * Set the relocation preference.
     *
     * @param string $relocate
     * @return void
     */
    public function setRelocate($relocate): void
    {
        $this->_relocate = $relocate;
    }

    /**
     * Get the biography.
     *
     * @return string
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Set the biography.
     *
     * @param string $bio
     * @return void
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }


}
