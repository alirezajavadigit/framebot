<?php

namespace App\Traits\TelegramMethods;

trait BanChatMember
{
    /**
     * Ban a user from a chat.
     *
     * @param array $value An array containing parameters for the banChatMember method.
     * @return array|null Returns the result of the banChatMember method.
     */
    protected function banChatMember($value)
    {
        // Call the messageRequestJson function to invoke the banChatMember method with the provided parameters.
        $result = messageRequestJson("banChatMember", $value);

        // Return the result obtained from the banChatMember method.
        return $result;
    }
}
