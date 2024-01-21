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
// Run Fat-Free
$f3->run(); // -> Invokes instance method in php

