<?php

namespace activities\Traits\TelegramMethods;

trait UnBanChatMember
{
    protected function unbanChatMember($value)
    {
        $result = messageRequestJson("unbanChatMember", $value);
        return $result;
    }
}
