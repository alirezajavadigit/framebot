<?php

namespace App\Traits\TelegramMethods;

trait EditMessageText
{
    protected function editMessageText($message)
    {
        /*
        Use this method to edit text and game messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
        */
        $result = messageRequestJson("editMessageText", $message);
        return $result;
    }
}
