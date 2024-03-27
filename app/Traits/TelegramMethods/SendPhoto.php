<?php

namespace App\Traits\TelegramMethods;

trait SendPhoto
{
    /**
     * Send a photo.
     *
     * @param array $value An array containing parameters for sending a photo.
     * @return array|null Returns the result of the sendPhoto method.
     */
    protected function sendPhoto($value)
    {
        // Call the messageRequestJson function to invoke the sendPhoto method with the provided parameters.
        $result = messageRequestJson("sendPhoto", $value);
        
        // Return the result obtained from the sendPhoto method.
        return $result;
    }
}
