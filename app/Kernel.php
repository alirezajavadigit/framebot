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
| Kernel
|--------------------------------------------------------------------------
| The Kernel class serves as the core component of the Framebot framework,
| responsible for handling incoming messages and triggering appropriate actions.
|--------------------------------------------------------------------------
*/

namespace App; // Defines the namespace for the Kernel class.

use App\Model\User; // Import the User model from the App namespace.
use App\Action\Start; // Import the Start trait from the App\Traits\Action namespace.
use System\Kernel\Traits\HasAttribute;

class Kernel
{
    use Start, HasAttribute; // Use the Start trait to handle actions and the HasAttribute trait.

    /**
     * Constructor method to initialize the Kernel object with received content.
     *
     * @param string $content The JSON content received from the Telegram API.
     */
    function __construct($content)
    {
        $this->setAttribute($content);

        // Register actions to handle incoming requests.
        $this->registerActions();
    }

    /**
     * Register actions for handling incoming requests.
     *
     * This method is responsible for registering actions. It starts the action
     * registration process by calling the 'start' method. Ensure that necessary
     * actions are executed during initialization.
     */
    protected function registerActions()
    {
        // Start the action registration process.
        $this->start();
    }
}
