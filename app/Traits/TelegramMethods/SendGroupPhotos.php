<?php

namespace App\Traits\TelegramMethods;

trait SendGroupPhotos
{
    /**
     * Send a group of photos.
     *
     * @param array $value An array containing parameters for sending a group of photos.
     * @return array|null Returns the result of the sendMediaGroup method.
     */
    protected function sendGroupPhotos($value)
    {
        // Call the messageRequestJson function to invoke the sendMediaGroup method with the provided parameters.
        $result = messageRequestJson("sendMediaGroup", $value);
        
        // Return the result obtained from the sendMediaGroup method.
        return $result;
    }
}
