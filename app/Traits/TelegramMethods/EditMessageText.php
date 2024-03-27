<?php

namespace App\Traits\TelegramMethods;

trait EditMessageText
{
    /**
     * Edit the text of a message.
     *
     * @param array $message An array containing parameters for the editMessageText method.
     * @return array|null Returns the result of the editMessageText method.
     */
    protected function editMessageText($message)
    {
        // Call the messageRequestJson function to invoke the editMessageText method with the provided parameters.
        $result = messageRequestJson("editMessageText", $message);

        // Return the result obtained from the editMessageText method.
        return $result;
    }
}
