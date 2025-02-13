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
| System\TeleCore\Class\GetUserProfilePhotos
|--------------------------------------------------------------------------
| This class represents a request to get user profile photos in the Telegram bot system and provides
| methods for setting various parameters of the request. It automatically
| sends the request upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class GetUserProfilePhotos
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store request parameters.
     */
    private $params; // Array to store request parameters.

    /**
     * @var bool $ended Flag to indicate if the request has been sent.
     */
    private $ended = false; // Flag to indicate if the request has been sent.

    /**
     * Send the request with the set parameters.
     *
     * This method sends the request using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the GetUserProfilePhotos object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the request hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the request using the request method with the set parameters.
            $this->request("getUserProfilePhotos", $this->params);
        }
    }

    /**
     * Set the end flag and send the request.
     *
     * This method sets the end flag to true, indicating that the request has been sent,
     * and then sends the request using the request method with the set parameters.
     *
     * @return mixed The result of sending the request.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the request using the request method with the set parameters.
        return $this->request("getUserProfilePhotos", $this->params);
    }
}
