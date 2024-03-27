<?php

/**
 * PHP Import Statement
 * 
 * This line imports the Main class from the App namespace. Namespaces in PHP provide a way to 
 * organize code and avoid naming collisions. By importing the Main class, we ensure that we can 
 * refer to it directly without specifying the full namespace path every time we use it.
 * 
 * @uses App\Main
 */

use App\Main; // Import the Main class from the App namespace.

/**
 * Constant Definitions for Telegram API
 * 
 * This block of code defines two constants: TOKEN and API_URL. Constants are immutable values 
 * that can be accessed throughout the script. Here, TOKEN represents the authentication token 
 * required for accessing the Telegram API, while API_URL represents the base URL for making 
 * requests to the Telegram API endpoints. These constants provide a convenient way to manage 
 * and reuse these values throughout the script.
 *  Define constants for Telegram API token and base URL.
 * 
 * @constant TOKEN
 * @constant API_URL
 */
define('TOKEN', '6823690417:AAHKhC1rXafoK9liCfHl4bhSC8KKS3NLZgc');
define('API_URL', 'https://api.telegram.org/bot' . TOKEN . '/');

/**
 * Constant Definitions for Database Connection
 * 
 * This section defines constants for the database connection parameters. Each constant represents 
 * a different aspect of the database connection: DB_HOST for the hostname of the database server, 
 * DB_NAME for the name of the database, DB_USERNAME for the username used for authentication, 
 * and DB_PASSWORD for the password used for authentication. By defining these constants, we make 
 * it easier to manage database connection details and ensure consistency throughout the script.
 * Define constants for database connection.
 * 
 * @constant DB_HOST
 * @constant DB_NAME
 * @constant DB_USERNAME
 * @constant DB_PASSWORD
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'telegram');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

/**
 * Composer Autoloader Inclusion
 * 
 * This line requires the Composer autoloader file to load project dependencies. Composer is a 
 * popular dependency manager for PHP that simplifies the process of including and managing 
 * external libraries and packages. By including the autoloader file, we ensure that any classes 
 * or functions provided by external dependencies are automatically loaded and available for use 
 * within our script.
 * Require the Composer autoloader to load dependencies.
 * 
 * @see https://getcomposer.org/doc/01-basic-usage.md#autoloading
 */
require_once 'vendor/autoload.php';

/**
 * Webhook Request Content Retrieval
 * 
 * This line retrieves the raw content of the incoming webhook request from the Telegram API. 
 * Webhooks are a mechanism for real-time communication between web services, allowing 
 * applications to receive notifications or data as soon as it becomes available. In this case, 
 * we use the file_get_contents() function to read the content of the request from the PHP input 
 * stream, which contains the payload sent by the Telegram API.
 * Get the content of the incoming webhook request.
 * 
 * @see https://core.telegram.org/bots/api#setwebhook
 */
$content = file_get_contents("php://input");

/**
 * Main Class Instantiation
 * 
 * This line instantiates an object of the Main class from the App namespace, passing the 
 * retrieved content of the webhook request as a parameter. The Main class likely serves as the 
 * central component of the application, responsible for handling incoming webhook requests, 
 * processing data, and generating appropriate responses. By instantiating the Main class, we 
 * kickstart the execution of the application logic and begin processing the incoming webhook 
 * request to perform the desired actions.
 * Instantiate the Main class with the incoming content.
 * 
 * @uses App\Main
 */
$Main = new Main($content);
