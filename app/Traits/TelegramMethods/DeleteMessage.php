<?php

namespace App\Traits\TelegramMethods;

trait BanChatMember
{
    /**
     * Delete a message.
     *
     * @param array $value An array containing parameters for the deleteMessage method.
     * @return array|null Returns the result of the deleteMessage method.
     */
    protected function deleteMessage($value)
    {
        // Call the messageRequestJson function to invoke the deleteMessage method with the provided parameters.
        $result = messageRequestJson("deleteMessage", $value);

        // Return the result obtained from the deleteMessage method.
        return $result;
    }
}
