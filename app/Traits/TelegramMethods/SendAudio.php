<?php

namespace App\Traits\TelegramMethods;

trait SendAudio
{
    /*
    Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
    */
    protected function sendAudio($value)
    {
        $result = messageRequestJson("sendAudio", $value);
        return $result;
    }
}
