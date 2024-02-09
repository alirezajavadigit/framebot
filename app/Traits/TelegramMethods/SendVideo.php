<?php

namespace App\Traits\TelegramMethods;

trait SendVideo
{
    protected function sendVideo($value)
    {
        $result = messageRequestJson("sendVideo", $value);
        return $result;
    }
}
