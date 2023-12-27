<?php

namespace activities\Traits;

trait SendVideo
{
    protected function sendVideo($value)
    {
        $result = messageRequestJson("sendVideo", $value);
        return $result;
    }
}
