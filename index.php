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

require_once('vendor/autoload.php'); //Require the autoload file.

//Instantiate Fat-Free framework (F3)
$f3 = Base::instance(); // :: is invoking a static method in php

/**
 * Process form data and store it in the F3 hive.
 *
 * @param object $f3 The Fat-Free Framework object.
 * @param array $formFields An array of form field names.
 * @param string $redirect The URL to redirect to after processing the form data.
 * @return void
 */
function processFormData(object $f3, array $formFields, string $redirect): void {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($formFields as $field) { // Store form data in the F3 hive
            $f3->set($field, $_POST[$field]);
        }

        $f3->reroute($redirect);
    }
}

// Default route to - HOME
$f3->route('GET /', function () {
    $view = new Template();
    echo $view->render('views/home.html');
});

// Route to PERSONAL-INFO
$f3->route('GET|POST /info', function ($f3) {
    processFormData($f3, ['first_name', 'last_name', 'email', 'state', 'phone'], '/experience');

    $view = new Template();
    echo $view->render('views/personal-info.html');
});

// Route to EXPERIENCE
$f3->route('GET|POST /experience', function ($f3) {
    processFormData($f3, ['bio', 'github', 'experience', 'relocate'], '/mail');

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
