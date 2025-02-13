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
| System\TeleCore\Class\SendPaidMedia
|--------------------------------------------------------------------------
| This class represents a paid media message in the Telegram bot system and provides
| methods for setting various parameters of the paid media. It automatically
| sends the paid media upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SendPaidMedia
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the paid media has been sent.
     */
    private $ended = false; // Flag to indicate if the paid media has been sent.

    /**
     * Send the paid media with the set parameters.
     *
     * This method sends the paid media using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SendPaidMedia object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the paid media hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the paid media using the request method with the set parameters.
            $this->request("sendPaidMedia", $this->params);
        }
    }

    /**
     * Set the end flag and send the paid media.
     *
     * This method sets the end flag to true, indicating that the paid media has been sent,
     * and then sends the paid media using the request method with the set parameters.
     *
     * @return mixed The result of sending the paid media.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the paid media using the request method with the set parameters.
        return $this->request("sendPaidMedia", $this->params);
    }
}
