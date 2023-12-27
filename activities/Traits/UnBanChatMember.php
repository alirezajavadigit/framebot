<?php

namespace activities\Traits;

trait UnBanChatMember
{
    protected function unbanChatMember($value)
    {
        $result = messageRequestJson("unbanChatMember", $value);
        return $result;
    }
}
