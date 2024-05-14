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
| trait Start
|--------------------------------------------------------------------------
| This trait contains methods related to handling the "/start" command.
|--------------------------------------------------------------------------
*/

namespace App\Action;

use System\TeleCore\Class\Message;

trait Start
{
    /**
     * Start method to handle the "/start" command.
     * Sends a welcome message to the user.
     *
     * @return void
     */
    protected function start()
    {
        if ($this->text == "/start") {
            Message::chatId($this->chatID)->text("hi thank you for using my framework renew All");
        }
    }
}
