<?php
/**
 * Braedon Billingsley
 * 01/20/24
 * https://www.bbillingsley.greenriverdev.com/home/bbilling/public_html/328/application
 * This is my CONTROLLER for the application app.
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file.
require_once('vendor/autoload.php');

//Instantiate Fat-Free framework (F3)
$f3 = Base::instance(); // :: is invoking a static method in php

// Define a default route.
$f3->route('GET /', function () { // Anonymous function
    // Display a view page
    $view = new Template();
    echo $view->render('views/home.html');

});

$f3->route('GET|POST /info', function ($f3) { // Anonymous function

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $f3->reroute('/experience');

        // TODO store in session, redirect to mail, then summary while storing user data in session.
    }
    // Display a view page
    $view = new Template();
    echo $view->render('views/personal-info.html');
});

$f3->route('GET|POST /experience', function () { // Anonymous function
    // Display a view page
    $view = new Template();
    echo $view->render('views/experience.html');

});
// Run Fat-Free
$f3->run(); // -> Invokes instance method in php

