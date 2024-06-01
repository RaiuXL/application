<?php
/**
 * My controller class for the  job application project
 * 328/application/controllers/controller.php
 *
 */
require_once('model/validate.php');

class Controller
{
    private $_F3; // Fat-Free Router

    /**
     * @param $_F3
     */
    public function __construct($_F3)
    {
        $this->_F3 = $_F3;
    }

    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');
    }

    function information()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){

            if (isset($_POST['fname']) and validName($_POST['fname'])) {
                $fname = $_POST['fname'];
            }
            else {
                $this->_F3->set('errors["fname"]', 'Please enter a first name');
            }

            if (isset($_POST['lname']) and validName($_POST['lname'])) {
                $lname = $_POST['lname'];
            }
            else {
                $this->_F3->set('errors["lname"]', 'Please enter a last name');
            }

            if (isset($_POST['email']) and validEmail($_POST['email'])) {
                $email = $_POST['email'];
            }
            else {
                $this->_F3->set('errors["email"]', 'Please enter an email');
            }

            if (isset($_POST['phone']) and validPhone($_POST['phone'])) {
                $phone = $_POST['phone'];
            }
            else {
                $this->_F3->set('errors["phone"]', 'Please enter a phone number');
            }

            $state = $_POST['state'];

            $this->_F3->set('SESSION.fname',$fname);
            $this->_F3->set('SESSION.lname',$lname);
            $this->_F3->set('SESSION.email',$email);
            $this->_F3->set('SESSION.state',$state);
            $this->_F3->set('SESSION.phone',$phone);


            if(empty($this->_F3->get('errors'))) {
                $this->_F3->reroute('experience');
            }
        }
        $states = getStates();
        $this->_F3->set('states', $states);

        $view = new Template();
        echo $view->render('views/info.html');
    }

    function experience()
    {
        if($_SERVER['REQUEST_METHOD']=='POST'){

            if (isset($_POST['link']) and validLink($_POST['link'])) {
                $link = $_POST['link'];
            } else {
                $this->_F3->set('errors["link"]', 'Please enter a valid URL');
            }

            if (isset($_POST['yearsInExperience']) and validExperience($_POST['yearsInExperience'])) {
                $yearsInExperience = $_POST['yearsInExperience'];
            } else {
                $this->_F3->set('errors["yearsInExperience"]', 'Please select years of experience');
            }

            if (isset($_POST['willingToRelocate']) and validRelocationOption($_POST['willingToRelocate'])) {
                $willingToRelocate = $_POST['willingToRelocate'];
            } else {
                $this->_F3->set('errors["willingToRelocate"]', 'Please select relocation preferences');
            }

            if (isset($_POST['bio']) and validBiography($_POST['bio'])) {
                $bio = $_POST['bio'];
            } else {
                $this->_F3->set('errors["bio"]', 'Please tell us more about yourself!');
            }

            $this->_F3->set('SESSION.bio',$bio);
            $this->_F3->set('SESSION.link',$link);
            $this->_F3->set('SESSION.yearsInExperience',$yearsInExperience);
            $this->_F3->set('SESSION.willingToRelocate',$willingToRelocate);

            if(empty($this->_F3->get('errors'))) {
                $this->_F3->reroute('mailingList');
            }
        }

        $view = new Template();
        echo $view->render('views/experience.html');
    }

    function mailingList()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $selectedCheckboxes = [];

            // Check for selected job openings
            foreach (getJobOpenings() as $job) {
                if (isset($_POST['jobOpenings']) && in_array($job, $_POST['jobOpenings'])) {
                    $selectedCheckboxes[] = $job;
                }
            }

            // Check for selected industry verticals
            foreach (getIndustryVerticals() as $vertical) {
                if (isset($_POST['industryVerticals']) && in_array($vertical, $_POST['industryVerticals'])) {
                    $selectedCheckboxes[] = $vertical;
                }
            }

            // Save the selected checkboxes to session
            $this->_F3->set('SESSION.selectedCheckboxes', $selectedCheckboxes);

            // Redirect to the next page
            $this->_F3->reroute("summary");
        }

        $jobOpenings = getJobOpenings();
        $industryVerticals = getIndustryVerticals();

        // Save the available options to session
        $this->_F3->set('jobOpenings', $jobOpenings);
        $this->_F3->set('industryVerticals', $industryVerticals);

        $view = new Template();
        echo $view->render('views/mailingList.html');
    }

}