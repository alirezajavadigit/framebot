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
| System\TeleCore\Class\SendDice
|--------------------------------------------------------------------------
| This class represents a dice message in the Telegram bot system and provides
| methods for setting various parameters of the dice. It automatically
| sends the dice upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SendDice
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the dice has been sent.
     */
    private $ended = false; // Flag to indicate if the dice has been sent.

    /**
     * Send the dice with the set parameters.
     *
     * This method sends the dice using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SendDice object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the dice hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the dice using the request method with the set parameters.
            $this->request("sendDice", $this->params);
        }
    }

    /**
     * Set the end flag and send the dice.
     *
     * This method sets the end flag to true, indicating that the dice has been sent,
     * and then sends the dice using the request method with the set parameters.
     *
     * @return mixed The result of sending the dice.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the dice using the request method with the set parameters.
        return $this->request("sendDice", $this->params);
    }
}
