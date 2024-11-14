<?php
/*
|--------------------------------------------------------------------------
| Framebot
|--------------------------------------------------------------------------
| PHP framework for Telegram bot development. Fast, flexible, feature-rich.
|--------------------------------------------------------------------------
| @category  Framework
| @package   Framebot
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/framebot
|--------------------------------------------------------------------------
| HasAttribute Trait
|--------------------------------------------------------------------------
| This trait manages attributes for incoming data from the Telegram API,
| providing easy access to message details for processing bot interactions.
|--------------------------------------------------------------------------
*/

namespace System\Kernel\Traits;

trait HasAttribute
{
    /**
     * Holds the decoded JSON update received from the Telegram API.
     *
     * @var array
     */
    protected $update;

    /**
     * Stores the ID of the received message.
     *
     * @var int
     */
    protected $messageID;

    /**
     * Placeholder for user message text.
     *
     * @var string
     */
    protected $userMessage;

    /**
     * Text content of the received message.
     *
     * @var string
     */
    protected $text;

    /**
     * ID of the chat where the message originated.
     *
     * @var int
     */
    protected $chatID;

    /**
     * Sender's first name.
     *
     * @var string
     */
    protected $first_name;

    /**
     * Sender's last name.
     *
     * @var string
     */
    protected $last_name;

    /**
     * Sender's username.
     *
     * @var string
     */
    protected $username;

    /**
     * File ID of the attached photo, if available.
     *
     * @var string
     */
    protected $photo_id;

    /**
     * File ID of the attached video, if available.
     *
     * @var string
     */
    protected $video_id;

    /**
     * File ID of the attached audio file, if available.
     *
     * @var string
     */
    protected $audio_id;

    /**
     * File ID of the attached document, if available.
     *
     * @var string
     */
    protected $document_id;

    /**
     * Caption for the attached media, if available.
     *
     * @var string
     */
    protected $caption;

    /**
     * Data from an inline keyboard callback, if available.
     *
     * @var string
     */
    protected $callback;

    /**
     * ID of the chat associated with a callback query.
     *
     * @var int
     */
    protected $chat_id;

    /**
     * Callback query ID.
     *
     * @var string
     */
    protected $callback_query_id;

    /**
     * Chat type (e.g., private, group) for the callback.
     *
     * @var string
     */
    protected $type;

    /**
     * ID of the update.
     *
     * @var int
     */
    protected $update_id;

    /**
     * Text content of a callback message.
     *
     * @var string
     */
    protected $content;

    /**
     * Initializes attributes based on the provided JSON content.
     *
     * @param string $content The JSON content to decode and extract information from.
     */
    private function setAttribute($content)
    {
        // Decode the incoming JSON content and store in $this->update.
        $this->setUpdate($content);

        // Set the chat ID where the message originated.
        $this->setChatId();

        // Set the message text content, converting Persian numbers if necessary.
        $this->setText();

        // Set the unique message ID.
        $this->setMessageId();

        // If message sender's information is available, extract and store their details.
        if (isset($this->update['message']['from'])) {
            $this->setFirstName();
            $this->setLastName();
            $this->setUserName();
        }

        // Extract media file IDs if available, such as video, audio, document, or photo.
        if (isset($this->update['message']['video'])) $this->setVideoId();
        if (isset($this->update['message']['audio'])) $this->setAudioId();
        if (isset($this->update['message']['document'])) $this->setDocumentId();
        if (isset($this->update['message']['photo'][0]['file_id'])) $this->setPhotoId();

        // If a caption is present, store it.
        if (isset($this->update['message']['caption'])) $this->setCaption();

        // If the update includes callback data (from an inline keyboard), extract and store callback information.
        if (isset($this->update['callback_query']['data'])) {
            $this->setCallback();
            $this->setFirstName("callback_query");
            $this->setLastName("callback_query");
            $this->setUserName("callback_query");
            $this->setChatId("callback_query");
            $this->setCallbackQueryId();
            $this->setType();
            $this->setUpdateId();
            $this->setContent();
        }
    }

    // Individual setter methods for each attribute with comments explaining each step.

    /**
     * Sets the callback data.
     */
    public function setCallback()
    {
        $this->callback = $this->update['callback_query']['data']; // Retrieves and stores the callback data.
    }

    /**
     * Sets the callback query ID.
     */
    public function setCallbackQueryId()
    {
        $this->callback_query_id = $this->update['callback_query']['id']; // Retrieves and stores the callback query ID.
    }

    /**
     * Sets the type of chat (e.g., private, group) for the callback.
     */
    public function setType()
    {
        $this->type = $this->update['callback_query']['message']['chat']['type']; // Retrieves and stores the chat type.
    }

    /**
     * Sets the update ID.
     */
    public function setUpdateId()
    {
        $this->update_id = $this->update['callback_query']['message']['message_id']; // Retrieves and stores the update ID.
    }

    /**
     * Sets the content of a callback message.
     */
    public function setContent()
    {
        $this->content = $this->update['callback_query']['message']['text']; // Retrieves and stores callback message content.
    }

    /**
     * Sets the caption of the message, if available.
     */
    public function setCaption()
    {
        $this->caption = $this->update['message']['caption']; // Retrieves and stores caption text if present.
    }

    /**
     * Sets the photo ID, if a photo is attached.
     */
    public function setPhotoId()
    {
        $this->photo_id = end($this->update['message']['photo'])['file_id']; // Retrieves and stores the last photo file ID.
    }

    /**
     * Sets the document ID, if a document is attached.
     */
    public function setDocumentId()
    {
        $this->document_id = $this->update['message']['document']['file_id']; // Retrieves and stores the document file ID.
    }

    /**
     * Sets the audio ID, if an audio file is attached.
     */
    public function setAudioId()
    {
        $this->audio_id = $this->update['message']['audio']['file_id']; // Retrieves and stores the audio file ID.
    }

    /**
     * Sets the video ID, if a video is attached.
     */
    public function setVideoId()
    {
        $this->video_id = $this->update['message']['video']['file_id']; // Retrieves and stores the video file ID.
    }

    /**
     * Sets the username of the sender.
     *
     * @param string $type If "callback_query", sets username for callback.
     */
    public function setUserName($type = "normal")
    {
        $this->username = ($type === "normal") ?
            ($this->update['message']['from']['username'] ?? '') : // Checks if username exists for message.
            $this->update['callback_query']['from']['username'];    // Uses username for callback query if applicable.
    }

    /**
     * Sets the last name of the sender.
     *
     * @param string $type If "callback_query", sets last name for callback.
     */
    public function setLastName($type = "normal")
    {
        $this->last_name = ($type === "normal") ?
            ($this->update['message']['from']['last_name'] ?? '') : // Checks if last name exists for message.
            $this->update['callback_query']['from']['last_name'];   // Uses last name for callback query if applicable.
    }

    /**
     * Sets the first name of the sender.
     *
     * @param string $type If "callback_query", sets first name for callback.
     */
    public function setFirstName($type = "normal")
    {
        $this->first_name = ($type === "normal") ?
            ($this->update['message']['from']['first_name'] ?? '') : // Checks if first name exists for message.
            $this->update['callback_query']['from']['first_name'];   // Uses first name for callback query if applicable.
    }

    /**
     * Decodes the incoming JSON content and stores it as an array.
     *
     * @param string $content JSON string containing the Telegram update.
     */
    public function setUpdate($content)
    {
        $this->update = json_decode($content, true); // Decodes JSON content to associative array.
    }

    /**
     * Sets the unique message ID from the update.
     */
    public function setMessageId()
    {
        $this->messageID = $this->update['message']['message_id']; // Retrieves and stores the message ID.
    }

    /**
     * Sets the text content of the message, converting any Persian numbers to English.
     */
    public function setText()
    {
        $this->text = persianNumbersToEnglish($this->update['message']['text']); // Converts and stores the message text.
    }

    /**
     * Sets the chat ID where the message or callback originated.
     *
     * @param string $type If "callback_query", sets chat ID for callback.
     */
    public function setChatId($type = "normal")
    {
        $this->chatID = ($type === "normal") ?
            $this->update['message']['chat']['id'] :              // Retrieves chat ID from message.
            $this->update['callback_query']['from']['id'];        // Retrieves chat ID from callback query if applicable.
    }
}
