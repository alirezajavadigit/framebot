<?php

namespace App\Traits\TelegramMethods;

trait SendVideo
{
    /**
     * Send a video.
     *
     * @param array $value An array containing parameters for sending a video.
     * @return array|null Returns the result of the sendVideo method.
     */
    protected function sendVideo($value)
    {
        // Call the messageRequestJson function to invoke the sendVideo method with the provided parameters.
        $result = messageRequestJson("sendVideo", $value);
        
        // Return the result obtained from the sendVideo method.
        return $result;
    }
}
