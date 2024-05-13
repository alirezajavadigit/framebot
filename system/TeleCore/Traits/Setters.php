<?php
/*
|--------------------------------------------------------------------------
| Framebot
|--------------------------------------------------------------------------
| PHP framework for Telegram bot development. Fast, flexible, feature-rich.
|--------------------------------------------------------------------------
| @category  Framework
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/framebot
|--------------------------------------------------------------------------
| System\TeleCore\Traits\Setters
|--------------------------------------------------------------------------
| set available telegram methods as array to params
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Traits;

trait Setters
{
    /**
     * Set the business connection ID for the message.
     *
     * @param mixed $business_connection_id The ID of the business connection.
     * @return this Returns the current instance with the business connection ID set.
     */
    private function setBusinessConnectionId($business_connection_id)
    {
        $this->params['business_connection_id'] = $business_connection_id;
        return $this;
    }

    /**
     * Set the chat ID for the message.
     *
     * @param mixed $chat_id The ID of the chat.
     * @return this Returns the current instance with the chat ID set.
     */
    private function setChatId($chat_id)
    {
        $this->params['chat_id'] = $chat_id;
        return $this;
    }

    /**
     * Set the message thread ID for the message.
     *
     * @param mixed $message_thread_id The ID of the message thread.
     * @return this Returns the current instance with the message thread ID set.
     */
    private function setMessageThreadId($message_thread_id)
    {
        $this->params['message_thread_id'] = $message_thread_id;
        return $this;
    }

    /**
     * Set the entities for the message.
     *
     * @param array $entities The entities associated with the message.
     * @return this Returns the current instance with the entities set.
     */
    private function setEntities($entities)
    {
        $this->params['entities'] = $entities;
        return $this;
    }

    /**
     * Set the link preview options for the message.
     *
     * @param mixed $link_preview_options The link preview options for the message.
     * @return this Returns the current instance with the link preview options set.
     */
    private function setLinkPreviewOptions($link_preview_options)
    {
        $this->params['link_preview_options'] = $link_preview_options;
        return $this;
    }

    /**
     * Set whether to disable notification for the message.
     *
     * @param bool $disable_notification Whether to disable notification.
     * @return this Returns the current instance with the notification settings set.
     */
    private function setDisableNotification($disable_notification)
    {
        $this->params['disable_notification'] = $disable_notification;
        return $this;
    }

    /**
     * Set the reply parameters for the message.
     *
     * @param array $reply_parameters The parameters for replying to the message.
     * @return this Returns the current instance with the reply parameters set.
     */
    private function setReplyParameters($reply_parameters)
    {
        $this->params['reply_parameters'] = $reply_parameters;
        return $this;
    }

    /**
     * Set the reply markup for the message.
     *
     * @param mixed $reply_markup The reply markup for the message.
     * @return this Returns the current instance with the reply markup set.
     */
    private function setReplyMarkup($reply_markup)
    {
        $this->params['reply_markup'] = $reply_markup;
        return $this;
    }

    /**
     * Set whether to protect content for the message.
     *
     * @param bool $protect_content Whether to protect content.
     * @return this Returns the current instance with the content protection settings set.
     */
    private function setProtectContent($protect_content)
    {
        $this->params['protect_content'] = $protect_content;
        return $this;
    }

    /**
     * Set the text content of the message.
     *
     * @param string $text The text content of the message.
     * @return this Returns the current instance with the text content set.
     */
    private function setText($text)
    {
        $this->params['text'] = $text;
        return $this;
    }

    /**
     * Set the parse mode for the message.
     *
     * @param string $parse_mode The parse mode for the message.
     * @return this Returns the current instance with the parse mode set.
     */
    private function setParseMode($parse_mode)
    {
        $this->params['parse_mode'] = $parse_mode;
        return $this;
    }

    /**
     * Set the chat ID of the sender.
     *
     * @param int $from_chat_id The chat ID of the sender.
     * @return this Returns the current instance with the sender's chat ID set.
     */
    private function setFromChatId($from_chat_id)
    {
        $this->params['from_chat_id'] = $from_chat_id;
        return $this;
    }

    /**
     * Set the message ID.
     *
     * @param int $message_id The ID of the message.
     * @return this Returns the current instance with the message ID set.
     */
    private function setMessageId($message_id)
    {
        $this->params['message_id'] = $message_id;
        return $this;
    }

    /**
     * Set an array of message IDs.
     *
     * @param array $message_ids An array of message IDs.
     * @return this Returns the current instance with the message IDs set.
     */
    private function setMessageIds(array $message_ids)
    {
        $this->params['message_ids'] = $message_ids;
        return $this;
    }

    /**
     * Set a caption for the message.
     *
     * @param string $caption The caption for the message.
     * @return this Returns the current instance with the caption set.
     */
    private function setCaption($caption)
    {
        $this->params['caption'] = $caption;
        return $this;
    }

    /**
     * Set entities for the caption.
     *
     * @param array $caption_entities An array of entities for the caption.
     * @return this Returns the current instance with the caption entities set.
     */
    private function setCaptionEntities($caption_entities)
    {
        $this->params['caption_entities'] = $caption_entities;
        return $this;
    }

    /**
     * Set a photo for the message.
     *
     * @param string $photo The photo for the message.
     * @return this Returns the current instance with the photo set.
     */
    private function setPhoto($photo)
    {
        $this->params['photo'] = $photo;
        return $this;
    }

    /**
     * Set whether the message has a spoiler.
     *
     * @param bool $has_spoiler A boolean value indicating whether the message has a spoiler.
     * @return this Returns the current instance with the spoiler flag set.
     */
    private function setHasSpoiler($has_spoiler)
    {
        $this->params['has_spoiler'] = $has_spoiler;
        return $this;
    }
}
