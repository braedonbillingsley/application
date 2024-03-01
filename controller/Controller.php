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

    public function __construct(mixed $f3) {
        $this->_f3 = $f3;
    }

    function home(): void {
        $view = new Template(); // Render home.html page
        echo $view->render('views/home.html');
    }

    function info(mixed $f3): void { //TODO DataLayer and FormController
        // Get required and non required fields and pass to form controller and reroute to experience page
        $requiredFields = $GLOBALS['dataLayer']->getPersonalInfoFormFields();
        $nonRequiredFields = $GLOBALS['dataLayer']->getOptionalPersonalInfoFormFields();
        $GLOBALS['formController']->processFormData($f3, $requiredFields, $nonRequiredFields, '/experience');

        // Render the personal-info page
        $view = new Template();
        echo $view->render('views/personal-info.html');
    }

    function experience(mixed $f3): void {
        // Get required and non required fields and pass to form controller and reroute to mail
        $requiredFields = $GLOBALS['dataLayer']->getExperienceFormFields();
        $nonRequiredFields = $GLOBALS['dataLayer']->getOptionalExperienceFormFields();
        $GLOBALS['formController']->processFormData($f3, $requiredFields, $nonRequiredFields, '/mail');

        // Render the experience page
        $view = new Template();
        echo $view->render('views/experience.html');
    }

    function mail(mixed $f3): void {
        // Save mail fields to F3 and session and reroute to summary
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $selected_technologies = $_POST['tech'] ?? [];
            $selected_industries = $_POST['ind'] ?? [];
            $_SESSION['selected_technologies'] = $selected_technologies;
            $_SESSION['selected_industries'] = $selected_industries;
            $f3->set('selected_technologies', $selected_technologies);
            $f3->set('selected_industries', $selected_industries);
            $f3->reroute('/summary');
        }
        // Render the mailing-list page
        $view = new Template();
        echo $view->render('views/mailing-list.html');
    }

    function summary(mixed $f3): void {
        // Load session variables
        foreach($_SESSION as $key => $value) {
            $f3->set($key, $value);
        }
        // Render the summary page
        $view = new Template();
        echo $view->render('views/summary.html');
    }

}
