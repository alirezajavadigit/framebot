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
| System\TeleCore\Class\SendPoll
|--------------------------------------------------------------------------
| This class represents a poll message in the Telegram bot system and provides
| methods for setting various parameters of the poll. It automatically
| sends the poll upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SendPoll
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the poll has been sent.
     */
    private $ended = false; // Flag to indicate if the poll has been sent.

    /**
     * Send the poll with the set parameters.
     *
     * This method sends the poll using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SendPoll object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the poll hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the poll using the request method with the set parameters.
            $this->request("sendPoll", $this->params);
        }
    }

    /**
     * Set the end flag and send the poll.
     *
     * This method sets the end flag to true, indicating that the poll has been sent,
     * and then sends the poll using the request method with the set parameters.
     *
     * @return mixed The result of sending the poll.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the poll using the request method with the set parameters.
        return $this->request("sendPoll", $this->params);
    }
}
