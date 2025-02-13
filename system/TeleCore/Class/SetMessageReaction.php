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
| System\TeleCore\Class\SetMessageReaction
|--------------------------------------------------------------------------
| This class represents a message reaction in the Telegram bot system and provides
| methods for setting various parameters of the message reaction. It automatically
| sends the message reaction upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SetMessageReaction
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the message reaction has been sent.
     */
    private $ended = false; // Flag to indicate if the message reaction has been sent.

    /**
     * Send the message reaction with the set parameters.
     *
     * This method sends the message reaction using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SetMessageReaction object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the message reaction hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the message reaction using the request method with the set parameters.
            $this->request("setMessageReaction", $this->params);
        }
    }

    /**
     * Set the end flag and send the message reaction.
     *
     * This method sets the end flag to true, indicating that the message reaction has been sent,
     * and then sends the message reaction using the request method with the set parameters.
     *
     * @return mixed The result of sending the message reaction.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the message reaction using the request method with the set parameters.
        return $this->request("setMessageReaction", $this->params);
    }
}
