<?php
use App\Main;


//config
define('TOKEN', '6823690417:AAHKhC1rXafoK9liCfHl4bhSC8KKS3NLZgc'); // Robot Token
define('API_URL', 'https://api.telegram.org/bot' . TOKEN . '/'); // the trl this script will request to
// database config
define('DB_HOST', 'localhost');
define('DB_NAME', 'telegram');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');



// loading files
require_once 'database/DataBase.php';

require_once 'vendor/autoload.php';

// call main class to start bot
$content = file_get_contents("php://input");
$Main = new Main($content);