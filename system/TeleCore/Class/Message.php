<?php

/*
|--------------------------------------------------------------------------
| Framebot
|--------------------------------------------------------------------------
| PHP framework for Telegram bot development. Fast, flexible, feature-rich.
|--------------------------------------------------------------------------
| @category  Framework
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/framebot
|--------------------------------------------------------------------------
| System\TeleCore\Class\Message
|--------------------------------------------------------------------------
| This class represents a message in the Telegram bot system and provides methods
| for setting various parameters of the message. It automatically sends the
| message upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class Message
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params;

    /**
     * Send the message with the set parameters.
     *
     * This method sends the message using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the Message object.
     *
     * @return void
     */
    public function __destruct()
    {
        $this->request("sendMessage", $this->params);
    }
}
