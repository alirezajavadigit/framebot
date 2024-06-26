<?php

/*
|--------------------------------------------------------------------------
| Including Kernel Class
|--------------------------------------------------------------------------
|
| Import the Kernel class from the App namespace to use it in this script.
|
*/

use App\Kernel;

/*
|--------------------------------------------------------------------------
| Autoloading Dependencies
|--------------------------------------------------------------------------
|
| Require the Composer autoload file to autoload all dependencies.
|
*/

require_once 'vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Loading Environment Variables
|--------------------------------------------------------------------------
|
| Create an immutable dotenv instance to load environment variables from
| the .env file in the current directory.
|
*/
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Display errors if the application is in development mode.
if (env("APP_ENV") === "development") {
    // Set PHP to display errors.
    ini_set("display_errors", "on");

    // Report all errors.
    error_reporting(E_ALL);
}

/*
|--------------------------------------------------------------------------
| Defining API URL
|--------------------------------------------------------------------------
|
| Define a constant API_URL by concatenating it with the token retrieved
| from the environment variables.
|
*/
define('API_URL', 'https://api.telegram.org/bot' . env('TOKEN') . '/');

/*
|--------------------------------------------------------------------------
| Retrieving Raw Input Data
|--------------------------------------------------------------------------
|
| Get the raw POST data from the input stream.
|
*/
$content = file_get_contents("php://input");

/*
|--------------------------------------------------------------------------
| Instantiating Kernel Class
|--------------------------------------------------------------------------
|
| Instantiate the Kernel class, passing in the raw input data.
|
*/
$Kernel = new Kernel($content);
