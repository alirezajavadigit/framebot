<?php

namespace activities\Traits\TelegramMethods;

trait BanChatMember
{
    /*
    Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. 
    @ Returns True on success.
    */
    protected function banChatMember($value)
    {
        $result = messageRequestJson("banChatMember", $value);
        return $result;
    }
}
