<?php
/**
 * My controller class for the  job application project
 * 328/application/controllers/controller.php
 *
 */
require_once('model/validate.php');

/**
 * Class Controller
 *
 * This class handles routing and processing for the job application.
 */
class Controller
{
    private $_F3; // Fat-Free Router

    /**
     * Constructor
     *
     * @param object $_F3 Fat-Free Framework instance
     */
    public function __construct($_F3)
    {
        $this->_F3 = $_F3;
    }

    /**
     * Home route
     *
     * @return void
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Summary route
     *
     * @return void
     */
    function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');
    }

    /**
     * Information route
     *
     * @return void
     */
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

            // Handle mailing list checkbox
            $mailingListStatus = isset($_POST['mailingListStatus']) ? $_POST['mailingListStatus'] : 'no';

            // Handle file upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $this->_F3->set('errors["file"]', 'File is not an image.');
                    $uploadOk = 0;
                }

                if (file_exists($target_file)) {
                    $this->_F3->set('errors["file"]', 'Sorry, file already exists.');
                    $uploadOk = 0;
                }

                if ($_FILES["fileToUpload"]["size"] > 500000) { // 500KB limit
                    $this->_F3->set('errors["file"]', 'Sorry, your file is too large.');
                    $uploadOk = 0;
                }

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    $this->_F3->set('errors["file"]', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $this->_F3->set('SESSION.uploadedFile', $target_file);
                    } else {
                        $this->_F3->set('errors["file"]', 'Sorry, there was an error uploading your file.');
                    }
                }
            }

            if(empty($this->_F3->get('errors'))) {
                // Instantiate the appropriate class based on mailing list checkbox
                if ($mailingListStatus === 'yes') {
                    $applicant = new Applicant_SubscribedToLists($fname, $lname, $email, $state, $phone, '', '', '', '', [], []);
                } else {
                    $applicant = new Applicant($fname, $lname, $email, $state, $phone, '', '', '', '');
                }

                // Store the applicant object in the session
                $this->_F3->set('SESSION.applicant', $applicant);
                $this->_F3->reroute('experience');
            }
        }
        $states = getStates();
        $this->_F3->set('states', $states);

        $view = new Template();
        echo $view->render('views/info.html');
    }

    /**
     * Experience route
     *
     * @return void
     */
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

            // Retrieve the applicant object from the session
            $applicant = $this->_F3->get('SESSION.applicant');

            // Update the applicant object with the experience information
            $applicant->setLink($link);
            $applicant->setExperience($yearsInExperience);
            $applicant->setRelocate($willingToRelocate);
            $applicant->setBio($bio);

            // Store the updated applicant object back in the session
            $this->_F3->set('SESSION.applicant', $applicant);

            if (empty($this->_F3->get('errors'))) {
                if ($applicant instanceof Applicant_SubscribedToLists) {
                    $this->_F3->reroute('mailingList');
                } else {
                    $this->_F3->reroute('summary');
                }
            }
        }

        $view = new Template();
        echo $view->render('views/experience.html');
    }

    /**
     * Mailing List route
     *
     * @return void
     */
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

            // Retrieve the applicant object from the session
            $applicant = $this->_F3->get('SESSION.applicant');

            // Update the applicant object with the mailing list information
            if ($applicant instanceof Applicant_SubscribedToLists) {
                $applicant->setSelectionsJobs($selectedCheckboxes);
                $applicant->setSelectionsVerticals($selectedCheckboxes);
            }

            // Store the updated applicant object back in the session
            $this->_F3->set('SESSION.applicant', $applicant);

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

    public function handleFileUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate the file...
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) { // 500KB limit
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $this->_F3->set('SESSION.uploadedFile', $target_file);
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }
}