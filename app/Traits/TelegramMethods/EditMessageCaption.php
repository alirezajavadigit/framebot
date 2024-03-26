<?php

namespace App\Traits\TelegramMethods;

trait EditMessageCaption
{
    /**
     * Edit the caption of a message.
     *
     * @param array $value An array containing parameters for the editMessageCaption method.
     * @return array|null Returns the result of the editMessageCaption method.
     */
    protected function editMessageCaption($value)
    {
        // Call the messageRequestJson function to invoke the editMessageCaption method with the provided parameters.
        $result = messageRequestJson("editMessageCaption", $value);

        // Return the result obtained from the editMessageCaption method.
        return $result;
    }
}
