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
| System\TeleCore\Class\CopyMessages
|--------------------------------------------------------------------------
| This class represents a message in the Telegram bot system and provides methods
| for setting various parameters of the message. It automatically copies the
| message upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class CopyMessages
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the message has been copied.
     */
    private $ended = false; // Flag to indicate if the message has been copied.

    /**
     * Copy the message with the set parameters.
     *
     * This method copies the message using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the Message object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the message hasn't already been copied to avoid duplicate sending.
        if (!$this->ended) {
            // Copy the message using the request method with the set parameters.
            $this->request("copyMessages", $this->params);
        }
    }

    /**
     * Set the end flag and copy the message.
     *
     * This method sets the end flag to true, indicating that the message has been copied,
     * and then copies the message using the request method with the set parameters.
     *
     * @return mixed The result of copying the message.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Copy the message using the request method with the set parameters.
        return $this->request("copyMessages", $this->params);
    }
}
