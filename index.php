<?php

/*
|--------------------------------------------------------------------------
| Including Main Class
|--------------------------------------------------------------------------
|
| Import the Main class from the App namespace to use it in this script.
|
*/

use App\Main;

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

/*
|--------------------------------------------------------------------------
| Defining API URL
|--------------------------------------------------------------------------
|
| Define a constant API_URL by concatenating it with the token retrieved
| from the environment variables.
|
*/
define('API_URL', 'https://api.telegram.org/bot' . getenv('TOKEN') . '/');

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
| Instantiating Main Class
|--------------------------------------------------------------------------
|
| Instantiate the Main class, passing in the raw input data.
|
*/
$Main = new Main($content);
