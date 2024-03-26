<?php

namespace App\Traits\TelegramMethods;

trait CreateChaInviteLink
{
    /**
     * Create an additional invite link for a chat.
     *
     * @param array $value An array containing parameters for the createChatInviteLink method.
     * @return array|null Returns the result of the createChatInviteLink method.
     */
    protected function createChatInviteLink($value)
    {
        // Call the messageRequestJson function to invoke the createChatInviteLink method with the provided parameters.
        $result = messageRequestJson("createChatInviteLink", $value);
        
        // Return the result obtained from the createChatInviteLink method.
        return $result;
    }
}
