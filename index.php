<?php
/**
 * This is my CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

// Require autoload.php to include required packages
require_once('vendor/autoload.php');

//Turn on error reporting and start the session
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Instantiate Fat-Free framework (F3) and form controller/ data layer classes
$f3 = Base::instance(); // :: is invoking a static method in php
$con = new Controller($f3);
$formController = new FormController();
$dataLayer = new DataLayer();

// Default route to HOME
$f3->route('GET /', function () {
    $GLOBALS['con']->home();
});

// Route to PERSONAL-INFO
$f3->route('GET|POST /info', function ($f3) use ($dataLayer, $formController) {
    $GLOBALS['con']->info($f3);
});

// Route to EXPERIENCE
$f3->route('GET|POST /experience', function ($f3) use ($dataLayer, $formController) {
    $GLOBALS['con']->experience($f3);
});

// Route to MAIL
$f3->route('GET|POST /mail', function ($f3) {
    $GLOBALS['con']->mail($f3);
});

// Route to SUMMARY
$f3->route('GET|POST /summary', function($f3) {
    $GLOBALS['con']->summary($f3);
});

// Run F3
$f3->run();
