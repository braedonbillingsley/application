<?php
/**
 * This is my CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

class Controller {
    private mixed $_f3; // Represents fat free router

    /**
     * Constructs a new instance of the class.
     *
     * @param mixed $f3 The F3 parameter.
     *
     * @return void
     */
    public function __construct(mixed $f3) {
        $this->_f3 = $f3;
    }

    /**
     * Renders the home page.
     *
     * @return void
     */
    function home(): void {
        $view = new Template(); // Render home.html page
        echo $view->render('app/views/home.html');
    }

    /**
     * Retrieves information and handles form submission for the personal info page.
     *
     * @param mixed $f3 The F3 parameter.
     *
     * @return void
     */
    function info(mixed $f3): void {
        // Get required and non required fields and pass to form controller and reroute to experience page
        $requiredFields = $GLOBALS['dataLayer']->getPersonalInfoFormFields();
        $nonRequiredFields = $GLOBALS['dataLayer']->getOptionalPersonalInfoFormFields();

        // Conditional object creation
        if (isset($_POST['mailing']) && $_POST['mailing']) {
            $this->_f3->set('SESSION.mailing', $_POST['mailing']);
            $applicant = new Applicant_SubscribedToLists([], [], $_POST['first_name']?? '', $_POST['last_name']?? '', $_POST['email']?? '', $_POST['state']?? '', $_POST['phone']?? '');
        } else {
            $applicant = new Applicant($_POST['first_name']?? '', $_POST['last_name']?? '', $_POST['email']?? '', $_POST['state']?? '', $_POST['phone']?? '');
        }

        // Store in Session
        $this->_f3->set('SESSION.applicant', $applicant);

        // Reroute to the mailing-list page if checked, otherwise reroute to summary page
        $GLOBALS['formController']->processFormData($f3, $requiredFields, $nonRequiredFields, '/experience');

        // Render the personal-info page
        $view = new Template();
        echo $view->render('app/views/personal-info.html');
    }

    /**
     * Process the experience form and update the applicant object with the submitted data.
     *
     * @param mixed $f3 The Fat-Free Framework instance.
     *
     * @return void
     */
    function experience(mixed $f3): void {
        // Get required and non-required fields (assuming these remain unchanged)
        $requiredFields = $GLOBALS['dataLayer']->getExperienceFormFields();
        $nonRequiredFields = $GLOBALS['dataLayer']->getOptionalExperienceFormFields();

        // Process form data
        $GLOBALS['formController']->processFormData($f3, $requiredFields, $nonRequiredFields, !$_SESSION['mailing'] ? '/summary' : '/mail');

        // Retrieve the applicant object from the session
        $applicant = $this->_f3->get('applicant');

        // Update the applicant object with experience data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $applicant->setExperience($_POST['experience'] ?? '');
            $applicant->setRelocate($_POST['relocate'] ?? false);
            $applicant->setBio($_POST['bio'] ?? '');
            $applicant->setGithub($_POST['github'] ?? '');
            $applicant->setSelectionsJobs($_POST['selections_jobs'] ?? []);
            $applicant->setSelectionsVerticals($_POST['selections_verticals'] ?? []);
        }

        // Render the experience page (likely passing the applicant data)
        $this->_f3->set('SESSION.applicant', $applicant); // Pass the applicant object to the template
        $view = new Template();
        echo $view->render('app/views/experience.html');
    }

    /**
     * Store selected technologies and industries in F3 session and redirect to summary page
     *
     * @param mixed $f3 The Fat-Free Framework object
     *
     * @return void
     */
    function mail(mixed $f3): void {
        // Define variables
        $this->_f3->set('selected_technologies', $_SESSION['selected_technologies'] ?? []);
        $this->_f3->set('selected_industries', $_SESSION['selected_industries'] ?? []);

        if ($this->_f3->exists("mailing")) { // if user is not logged into user session
            $f3->reroute('/'); // Redirect route to "login"
            exit;
        }

        // Save mail fields to F3 and session and reroute to summary
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selected_technologies = $_POST['tech'] ?? [];
            $selected_industries = $_POST['ind'] ?? [];
            $applicant = $this->_f3->get('SESSION.applicant');
            $this->_f3->set('selected_technologies', $selected_technologies);
            $this->_f3->set('selected_industries', $selected_industries);

            // Update the applicant object in the session
            if (isset($applicant) && $applicant instanceof Applicant_SubscribedToLists) {
                $applicant->setSelectionsJobs($_POST['tech'] ?? []);
                $applicant->setSelectionsVerticals($_POST['ind'] ?? []);
            }
            $f3->reroute('/summary');
        }

        // Render the mailing-list page
        $view = new Template();
        echo $view->render('app/views/mailing-list.html');
    }

    /**
     * Display the summary page for the application
     *
     * @param mixed $f3 The Fat-Free Framework object
     *
     * @return void
     */
    function summary(mixed $f3): void {
        var_dump($f3->get('SESSION.applicant'));
        $this->_f3->set('selected_technologies', $_SESSION['selected_technologies'] ?? []);
        $this->_f3->set('selected_industries', $_SESSION['selected_industries'] ?? []);

        // Render the summary page
        $view = new Template();
        echo $view->render('app/views/summary.html');
    }

}
