<?php

namespace App\Traits\Action;

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
        // Send a message to the user containing a welcome greeting.
        $this->sendMessage([
            "chat_id" => $this->userID, // Specify the chat ID of the user.
            "text" => "hi thank you for using my framework" // Provide the text of the message.
        ]);
    }
}
