<?php
use activities\Main;


//config
define('TOKEN', '6983736910:AAG6SGL9bjsZgnpyfj9W5Aghv1mauyW6jhA'); // Robot Token
define('API_URL', 'https://api.telegram.org/bot' . TOKEN . '/'); // the trl this script will request to
// database config
define('DB_HOST', 'localhost');
define('DB_NAME', 'telegram');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');



// loading files
require_once 'vendor/autoload.php';

// call main class to start bot
$content = file_get_contents("php://input");
$Main = new Main($content);