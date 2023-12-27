<?php

namespace activities\Acton;

trait Start{

    protected function startAction(){
        $this->sendMessage(["chat_id" => $this->userID, "Text" => "hello it's test"]);
    }
}