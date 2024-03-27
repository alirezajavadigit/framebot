<?php

namespace App\Traits\TelegramMethods;

trait SendAudio
{
    /**
     * Send audio files.
     *
     * @param array $value An array containing parameters for the sendAudio method.
     * @return array|null Returns the result of the sendAudio method.
     */
    protected function sendAudio($value)
    {
        // Call the messageRequestJson function to invoke the sendAudio method with the provided parameters.
        $result = messageRequestJson("sendAudio", $value);

        // Return the result obtained from the sendAudio method.
        return $result;
    }
}
