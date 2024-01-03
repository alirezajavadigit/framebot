<?php

namespace activities\Traits\TelegramMethods;

trait SendPhoto
{
    protected function sendPhoto($value)
    {
        /*
        Use this method to send photos. On success, the sent Message is returned.
        */
        $result = messageRequestJson("sendPhoto", $value);
        return $result;
    }
}
