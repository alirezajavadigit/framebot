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
| System\TeleCore\Class\Document
|--------------------------------------------------------------------------
| This class represents a document message in the Telegram bot system and provides
| methods for setting various parameters of the document message. It automatically
| sends the document upon destruction of the object.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Class;

use System\TeleCore\Traits\Caller;
use System\TeleCore\Traits\Request;
use System\TeleCore\Traits\Setters;

class Document
{
    use Request, Caller, Setters;

    /**
     * @var array $params Array to store message parameters.
     */
    private $params; // Array to store message parameters.

    /**
     * @var bool $ended Flag to indicate if the document has been sent.
     */
    private $ended = false; // Flag to indicate if the document has been sent.

    /**
     * Send the document with the set parameters.
     *
     * This method sends the document using the request method from the Request trait
     * with the parameters set in this class. It is automatically called upon destruction
     * of the Document object.
     *
     * @return void
     */
    public function __destruct()
    {
        // Check if the document hasn't already been sent to avoid duplicate sending.
        if (!$this->ended) {
            // Send the document using the request method with the set parameters.
            $this->request("sendDocument", $this->params);
        }
    }

    /**
     * Set the end flag and send the document.
     *
     * This method sets the end flag to true, indicating that the document has been sent,
     * and then sends the document using the request method with the set parameters.
     *
     * @return mixed The result of sending the document.
     */
    private function setEnd()
    {
        // Set the end flag to true.
        $this->ended = true;
        // Send the document using the request method with the set parameters.
        return $this->request("sendDocument", $this->params);
    }
}
