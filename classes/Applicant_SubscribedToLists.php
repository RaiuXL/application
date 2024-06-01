<?php
require_once ("Applicant.php");
/**
 * Class ApplicantSubscribedToLists
 *
 * This class represents an applicant who subscribed to mailing lists.
 */
class Applicant_SubscribedToLists extends Applicant {
    private $_selectionsJobs;
    private $_selectionsVerticals;

    /**
     * Constructor
     *
     * @param string $fname
     * @param string $lname
     * @param string $email
     * @param string $state
     * @param string $phone
     * @param string $github
     * @param string $experience
     * @param string $relocate
     * @param string $bio
     * @param array  $selectionsJobs
     * @param array  $selectionsVerticals
     */
    public function __construct($fname, $lname, $email, $state, $phone, $github, $experience, $relocate, $bio,  $selectionsJobs = [],  $selectionsVerticals = [])
    {
        // Call the parent constructor to initialize inherited properties
        parent::__construct($fname, $lname, $email, $state, $phone, $github, $experience, $relocate, $bio);

        // Initialize the new properties
        $this->_selectionsJobs = $selectionsJobs;
        $this->_selectionsVerticals = $selectionsVerticals;
    }

    /**
     * Return array of the selected jobs.
     *
     * @return array
     */
    public function getSelectionsJobs(): array
    {
        return $this->_selectionsJobs;
    }

    /**
     * Set the selected jobs.
     *
     * @param array $selectionsJobs
     * @return void
     */
    public function setSelectionsJobs(array $selectionsJobs): void
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    /**
     * Return array of the selected verticals.
     *
     * @return array
     */
    public function getSelectionsVerticals(): array
    {
        return $this->_selectionsVerticals;
    }


    /**
     * Set the selected verticals.
     *
     * @param array $selectionsVerticals
     * @return void
     */
    public function setSelectionsVerticals(array $selectionsVerticals): void
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }


}