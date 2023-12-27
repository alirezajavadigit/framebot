<?php

namespace activities;

use activities\Acton\Start;
use activities\Traits\SendMessage;

class Main
{
    use SendMessage, Start;
    protected $update;
    protected $messageID;
    protected $userMessage;
    protected $text;
    protected $userID;
    protected $first_name;
    protected $last_name;
    protected $username;
    protected $photo_id;
    protected $video_id;
    protected $audio_id;
    protected $document_id;
    protected $caption;
    
    // inline queries
    protected $callback;
    protected $chat_id;
    protected $callback_query_id;
    protected $type;
    protected $update_id;
    protected $content;
    
    function __construct($content)
    {
       
        $this->update = json_decode($content, true);
        $this->userID = $this->update['message']['chat']['id'];
        $this->text = persianNumbersToEnglish($this->update['message']['text']);
        $this->messageID = $this->update['message']['message_id'];
        if(isset($this->update['message']['from']['first_name'])){
            $this->first_name = $this->update['message']['from']['first_name'];
        }
        if(isset($this->update['message']['from']['first_name'])){
            $this->last_name = $this->update['message']['from']['last_name'];
        }
        if(isset($this->update['message']['from']['first_name'])){
            $this->username = $this->update['message']['from']['username'];
        }
        if (isset($this->update['message']['video'])) {
            $this->video_id = $this->update['message']['video']['file_id']; //video
        }
        if (isset($this->update['message']['audio'])) {
            $this->audio_id = $this->update['message']['audio']['file_id']; //audio
        }
        if (isset($this->update['message']['document'])) {
            $this->document_id = $this->update['message']['document']['file_id']; //document
        }
        if (isset($this->update['message']['photo'][0]['file_id'])) {
            $this->photo_id = end($this->update['message']['photo'])['file_id']; //photo
        }
        if (isset($this->update['message']['caption'])) {
            $this->caption = $this->update['message']['caption'];
        }
        if (isset($this->update['callback_query']['data'])) {
            $this->callback = $this->update['callback_query']['data'];
            $this->chat_id = $this->update['callback_query']['from']['id'];
            $this->first_name = $this->update['callback_query']['from']['first_name'];
            $this->last_name = $this->update['callback_query']['from']['last_name'];
            $this->username = $this->update['callback_query']['from']['username'];
            $this->callback_query_id = $this->update['callback_query']['id'];
            $this->type = $this->update['callback_query']['message']['chat']['type'];
            $this->update_id = $this->update['callback_query']['message']['message_id'];
            $this->content = $this->update['callback_query']['message']['text'];
        }

        $this->mainMenus();
    }

    //project main functions
    protected function mainMenus()
    {
        if ($this->text == "/start")
            $this->startAction();
    }


    protected function admin()
    {
    }
}
