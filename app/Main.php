<?php

namespace App;

use App\Model\User; // Import the User model from the App namespace.
use App\Traits\Action\Start; // Import the Start trait from the App\Traits\Action namespace.
use App\Traits\TelegramMethods\SendMessage; // Import the SendMessage trait from the App\Traits\TelegramMethods namespace.

class Main
{
    use SendMessage, Start; // Use the SendMessage and Start traits.

    // Declare protected properties to store various message details.
    protected $update; // Holds the decoded JSON update received from the Telegram API.
    protected $messageID; // Stores the ID of the received message.
    protected $userMessage; // Placeholder for future use to store user messages.
    protected $text; // Stores the text content of the received message.
    protected $userID; // Stores the ID of the user who sent the message.
    protected $first_name; // Stores the first name of the user who sent the message.
    protected $last_name; // Stores the last name of the user who sent the message.
    protected $username; // Stores the username of the user who sent the message.
    protected $photo_id; // Stores the ID of any photo attached to the message.
    protected $video_id; // Stores the ID of any video attached to the message.
    protected $audio_id; // Stores the ID of any audio file attached to the message.
    protected $document_id; // Stores the ID of any document attached to the message.
    protected $caption; // Stores the caption of the attached media (if applicable).
    protected $callback; // Stores the callback data received from inline keyboards.
    protected $chat_id; // Stores the ID of the chat where the callback originated.
    protected $callback_query_id; // Stores the ID of the callback query.
    protected $type; // Stores the type of chat where the callback originated (e.g., private, group).
    protected $update_id; // Stores the ID of the update.
    protected $content; // Stores the text content of the callback message.

    /**
     * Constructor method to initialize Main object with received content.
     *
     * @param string $content The JSON content received from the Telegram API.
     */
    function __construct($content)
    {
        // Decode the incoming JSON content.
        $this->update = json_decode($content, true);

        // Extract relevant information from the update.
        $this->userID = $this->update['message']['chat']['id'];
        $this->text = persianNumbersToEnglish($this->update['message']['text']);
        $this->messageID = $this->update['message']['message_id'];

        // Extract sender details if available.
        if (isset($this->update['message']['from'])) {
            $this->first_name = $this->update['message']['from']['first_name'];
            $this->last_name = $this->update['message']['from']['last_name'];
            $this->username = $this->update['message']['from']['username'];
        }

        // Extract file IDs if present in the message.
        if (isset($this->update['message']['video'])) {
            $this->video_id = $this->update['message']['video']['file_id'];
        }
        if (isset($this->update['message']['audio'])) {
            $this->audio_id = $this->update['message']['audio']['file_id'];
        }
        if (isset($this->update['message']['document'])) {
            $this->document_id = $this->update['message']['document']['file_id'];
        }
        if (isset($this->update['message']['photo'][0]['file_id'])) {
            $this->photo_id = end($this->update['message']['photo'])['file_id'];
        }

        // Extract caption if available.
        if (isset($this->update['message']['caption'])) {
            $this->caption = $this->update['message']['caption'];
        }

        // Extract callback details if present.
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

        // Call the mainMenus method to handle incoming requests.
        $this->mainMenus();
    }

    /**
     * Main method to handle incoming requests and trigger appropriate actions.
     */
    protected function mainMenus()
    {
        // Check if the received message is "/start" and call the start method.
        if ($this->text == "/start") {
            $this->start();
        }
    }
}
