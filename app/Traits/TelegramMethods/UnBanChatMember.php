<?php

namespace App\Traits\TelegramMethods;

trait UnBanChatMember
{
    /**
     * Unban a chat member.
     *
     * @param array $value An array containing parameters for unbanning a chat member.
     * @return array|null Returns the result of the unbanChatMember method.
     */
    protected function unbanChatMember($value)
    {
        // Call the messageRequestJson function to invoke the unbanChatMember method with the provided parameters.
        $result = messageRequestJson("unbanChatMember", $value);
        
        // Return the result obtained from the unbanChatMember method.
        return $result;
    }
}
