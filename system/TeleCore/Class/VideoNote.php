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
| System\TeleCore\Class\VideoNote
|--------------------------------------------------------------------------
| This class represents a video note message in the Telegram bot system and provides
| methods for setting various parameters of the video note. It automatically
| sends the video note upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class VideoNote
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the video note has been sent.
     */
    private $ended = false; // Flag to indicate if the video note has been sent.

    /**
     * Send the video note with the set parameters.
     *
     * This method sends the video note using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the VideoNote object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the video note hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the video note using the request method with the set parameters.
            $this->request("sendVideoNote", $this->params);
        }
    }

    /**
     * Set the end flag and send the video note.
     *
     * This method sets the end flag to true, indicating that the video note has been sent,
     * and then sends the video note using the request method with the set parameters.
     *
     * @return mixed The result of sending the video note.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the video note using the request method with the set parameters.
        return $this->request("sendVideoNote", $this->params);
    }
}
