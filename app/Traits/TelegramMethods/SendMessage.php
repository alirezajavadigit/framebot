<?php

namespace App\Traits\TelegramMethods;

trait SendMessage
{
    /**
     * Send a message.
     *
     * @param array $message An array containing parameters for sending a message.
     * @return array|null Returns the result of the sendMessage method.
     */
    protected function sendMessage($message)
    {
        // Call the messageRequestJson function to invoke the sendMessage method with the provided parameters.
        $result = messageRequestJson("sendMessage", $message);
        
        // Return the result obtained from the sendMessage method.
        return $result;
    }
}
