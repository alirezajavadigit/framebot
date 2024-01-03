<?php

namespace activities\Traits\TelegramMethods;

trait CreateChaInviteLink
{
    /*
    Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink object.
    */
    protected function createChatInviteLink($value)
    {
        $result = messageRequestJson("createChatInviteLink", $value);
        return $result;
    }
}
