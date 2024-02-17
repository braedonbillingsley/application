<?php
/**
 * This is my CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file.
require_once('vendor/autoload.php');

//Instantiate Fat-Free framework (F3)
$f3 = Base::instance(); // :: is invoking a static method in php

// function to process form data
function processFormData($f3, $formFields, $redirect): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Store form data in the F3 hive
        foreach ($formFields as $field) {
            $f3->set($field, $_POST[$field]);
        }

        $f3->reroute($redirect);
    }
}

//default route.
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// Route for personal info
$f3->route('GET|POST /info', function ($f3) {
    processFormData($f3, ['first_name', 'last_name', 'email', 'state', 'phone'], '/experience');

    $view = new Template();
    echo $view->render('views/personal-info.html');
});

// Route for experience
$f3->route('GET|POST /experience', function ($f3) {
    processFormData($f3, ['bio', 'github', 'experience', 'relocate'], '/mail');

    $view = new Template();
    echo $view->render('views/experience.html');
});

// Route for mail
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

$f3->route('GET|POST /summary', function($f3) {
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3->run();
