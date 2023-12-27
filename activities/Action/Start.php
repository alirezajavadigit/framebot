<?php

namespace activities\Action;

trait Start
{
    protected function start(){
        $this->sendMessage(["chat_id" => $this->userID, "text" => "hi thank you for using my framework"]);
    }
}
