<?php

namespace activities\Traits\TelegramMethods;

trait SendGroupPhotos
{
    protected function sendGroupPhotos($value)
    {
        /*
        Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type. On success, an array of Messages that were sent is returned.
        */
        $result = messageRequestJson("sendMediaGroup", $value);
        return $result;
    }
}
