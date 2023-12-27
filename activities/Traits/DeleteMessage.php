<?php

namespace activities\Traits;

trait BanChatMember
{
     /*
    Use this method to delete a message, including service messages, with the following limitations:
    - A message can only be deleted if it was sent less than 48 hours ago.
    - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
    - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
    - Bots can delete outgoing messages in private chats, groups, and supergroups.
    - Bots can delete incoming messages in private chats.
    - Bots granted can_post_messages permissions can delete outgoing messages in channels.
    - If the bot is an administrator of a group, it can delete any message there.
    - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
    @ Returns True on success.
    */
    protected function deleteMessage($value)
    {
        $result = messageRequestJson("deleteMessage", $value);
        return $result;
    }
}
