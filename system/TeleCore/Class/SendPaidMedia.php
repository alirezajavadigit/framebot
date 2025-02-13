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
| System\TeleCore\Class\SendMediaGroup
|--------------------------------------------------------------------------
| This class represents a media group message in the Telegram bot system and provides
| methods for setting various parameters of the media group. It automatically
| sends the media group upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class SendMediaGroup
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the media group has been sent.
     */
    private $ended = false; // Flag to indicate if the media group has been sent.

    /**
     * Send the media group with the set parameters.
     *
     * This method sends the media group using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the SendMediaGroup object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the media group hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the media group using the request method with the set parameters.
            $this->request("sendMediaGroup", $this->params);
        }
    }

    /**
     * Set the end flag and send the media group.
     *
     * This method sets the end flag to true, indicating that the media group has been sent,
     * and then sends the media group using the request method with the set parameters.
     *
     * @return mixed The result of sending the media group.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the media group using the request method with the set parameters.
        return $this->request("sendMediaGroup", $this->params);
    }
}
