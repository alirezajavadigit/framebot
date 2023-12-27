<?php 
namespace activities\Traits;
trait SendMessage{

    protected function sendMessage($message)
    {
        /* 
        Use this method to send text messages. On success, the sent Message is returned.
        */
        $result = messageRequestJson("sendMessage", $message);
        return $result;
    }
    
}