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
| System\TeleCore\Class\SendChatAction
|--------------------------------------------------------------------------
| This class represents a chat action message in the Telegram bot system and provides
| methods for setting various parameters of the chat action. It automatically
| sends the chat action upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SendChatAction
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the chat action has been sent.
     */
    private $ended = false; // Flag to indicate if the chat action has been sent.

    /**
     * Send the chat action with the set parameters.
     *
     * This method sends the chat action using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SendChatAction object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the chat action hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the chat action using the request method with the set parameters.
            $this->request("sendChatAction", $this->params);
        }
    }

    /**
     * Set the end flag and send the chat action.
     *
     * This method sets the end flag to true, indicating that the chat action has been sent,
     * and then sends the chat action using the request method with the set parameters.
     *
     * @return mixed The result of sending the chat action.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the chat action using the request method with the set parameters.
        return $this->request("sendChatAction", $this->params);
    }
}
