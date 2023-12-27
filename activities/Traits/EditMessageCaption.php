<?php

namespace activities\Traits;

trait EditMessageCaption
{
    /*
    Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
    */
    protected function editMessageCaption($value)
    {
        $result = messageRequestJson("editMessageCaption", $value);
        return $result;
    }
}
