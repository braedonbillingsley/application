<?php
/**
 * This is my CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

//Turn on error reporting and start the session
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Require autoload.php to include required packages
require_once('vendor/autoload.php');

// Instantiate Fat-Free framework (F3) and form controller/ data layer classes
$f3 = Base::instance(); // :: is invoking a static method in php
$form_controller = new FormController();
$data_layer = new DataLayer();

// Default route to HOME
$f3->route('GET /', function () {

    // Render the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Route to PERSONAL-INFO
$f3->route('GET|POST /info', function ($f3) use ($data_layer, $form_controller) {

    // Get required and non required fields and pass to form controller and reroute to experience page
    $requiredFields = $data_layer->getPersonalInfoFormFields();
    $nonRequiredFields = $data_layer->getOptionalPersonalInfoFormFields();
    $form_controller->processFormData($f3, $requiredFields, $nonRequiredFields, '/experience');

    // Render the personal-info page
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

// Route to EXPERIENCE
$f3->route('GET|POST /experience', function ($f3) use ($data_layer, $form_controller) {

    // Get required and non required fields and pass to form controller and reroute to mail
    $requiredFields = $data_layer->getExperienceFormFields();
    $nonRequiredFields = $data_layer->getOptionalExperienceFormFields();
    $form_controller->processFormData($f3, $requiredFields, $nonRequiredFields, '/mail');

    // Render the experience page
    $view = new Template();
    echo $view->render('views/experience.html');
});

// Route to MAIL
$f3->route('GET|POST /mail', function ($f3) {

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
});

// Route to SUMMARY
$f3->route('GET|POST /summary', function($f3) {

    // Load session variables
    foreach($_SESSION as $key => $value) {
        $f3->set($key, $value);
    }

    // Render the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run F3
$f3->run();
