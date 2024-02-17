<?php
/**
 * This is my CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

ini_set('display_errors', 1); //Turn on error reporting
error_reporting(E_ALL);
session_start(); // Start or resume session

require_once('vendor/autoload.php'); //Require the autoload file.

//Instantiate Fat-Free framework (F3) and classes
$f3 = Base::instance(); // :: is invoking a static method in php
$formController = new FormController();
$dataLayer = new DataLayer();

// Default route to - HOME
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// Route to PERSONAL-INFO
$f3->route('GET|POST /info', function ($f3) use ($dataLayer, $formController) {
    $formController->processFormData($f3, $dataLayer->getPersonalInfoFormFields(), '/experience');

    $view = new Template();
    echo $view->render('views/personal-info.html');
});

// Route to EXPERIENCE
$f3->route('GET|POST /experience', function ($f3) use ($dataLayer, $formController) {
    $formController->processFormData($f3, $dataLayer->getExperienceFormFields(), '/mail');

    $view = new Template();
    echo $view->render('views/experience.html');
});

// Route to MAIL
$f3->route('GET|POST /mail', function ($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $selected_technologies = array_filter($_POST, function($key) {
            return str_starts_with($key, 'tech-');
        }, ARRAY_FILTER_USE_KEY);

        $selected_industries = array_filter($_POST, function($key) {
            return str_starts_with($key, 'ind-');
        }, ARRAY_FILTER_USE_KEY);

        $f3->set('selected_technologies', $selected_technologies);
        $f3->set('selected_industries', $selected_industries);

        $f3->reroute('/summary');
    }

    $view = new Template();
    echo $view->render('views/mail.html');
});

// Route to SUMMARY
$f3->route('GET|POST /summary', function($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3->run();
