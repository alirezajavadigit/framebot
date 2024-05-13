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
| System\TeleCore\Class\ForwardMessages
|--------------------------------------------------------------------------
| This class represents a messages in the Telegram bot system and provides methods
| for setting various parameters of the messages. It automatically forward the
| messages upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class ForwardMessages
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store messages parameters.
     */
    private $params; // Array to store messages parameters.

    /**
     * @var bool $ended Flag to indicate if the messages has been forwarded.
     */
    private $ended = false; // Flag to indicate if the messages has been forwarded.

    /**
     * Forward the messages with the set parameters.
     *
     * This method forwards the messages using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the ForwardMessages object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the messages hasn't already been forwarded to avoid duplicate sending.
        if (!$this->ended) {
            // Send the messages using the request method with the set parameters.
            $this->request("forwardMessages", $this->params);
        }
    }

    /**
     * Set the end flag and forward the messages.
     *
     * This method sets the end flag to true, indicating that the messages has been forwarded,
     * and then forward the messages using the request method with the set parameters.
     *
     * @return mixed The result of sending the messages.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the messages using the request method with the set parameters.
        return $this->request("forwardMessages", $this->params);
    }
}
