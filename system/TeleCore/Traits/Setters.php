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
     * @return $this Returns the current instance with the photo set.
     */
    private function setPhoto($photo)
    {
        $this->params['photo'] = $photo; // Set the photo parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set whether the message has a spoiler.
     *
     * @param bool $has_spoiler A boolean value indicating whether the message has a spoiler.
     * @return $this Returns the current instance with the spoiler flag set.
     */
    private function setHasSpoiler($has_spoiler)
    {
        $this->params['has_spoiler'] = $has_spoiler; // Set the has_spoiler parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the audio for the message.
     *
     * @param mixed $audio The audio for the message.
     * @return $this Returns the current instance with the audio set.
     */
    private function setAudio($audio)
    {
        $this->params['audio'] = $audio; // Set the audio parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the duration of the audio.
     *
     * @param int $duration The duration of the audio.
     * @return $this Returns the current instance with the duration set.
     */
    private function setDuration($duration)
    {
        $this->params['duration'] = $duration; // Set the duration parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the performer of the audio.
     *
     * @param string $performer The performer of the audio.
     * @return $this Returns the current instance with the performer set.
     */
    private function setPerformer($performer)
    {
        $this->params['performer'] = $performer; // Set the performer parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the title of the audio.
     *
     * @param string $title The title of the audio.
     * @return $this Returns the current instance with the title set.
     */
    private function setTitle($title)
    {
        $this->params['title'] = $title; // Set the title parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the thumbnail for the message.
     *
     * @param string $thumbnail The thumbnail for the message.
     * @return $this Returns the current instance with the thumbnail set.
     */
    private function setThumbnail($thumbnail)
    {
        $this->params['thumbnail'] = $thumbnail; // Set the thumbnail parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the document for the message.
     *
     * @param mixed $document The document for the message.
     * @return $this Returns the current instance with the document set.
     */
    private function setDocument($document)
    {
        $this->params['document'] = $document; // Set the document parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set whether to disable content type detection.
     *
     * @param bool $disable_content_type_detection A boolean value indicating whether to disable content type detection.
     * @return $this Returns the current instance with the flag set.
     */
    private function setDisableContentTypeDetection($disable_content_type_detection)
    {
        $this->params['disable_content_type_detection'] = $disable_content_type_detection; // Set the disable_content_type_detection parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the video for the message.
     *
     * @param mixed $video The video for the message.
     * @return $this Returns the current instance with the video set.
     */
    private function setVideo($video)
    {
        $this->params['video'] = $video; // Set the video parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the width of the message.
     *
     * @param int $width The width of the message.
     * @return $this Returns the current instance with the width set.
     */
    private function setWidth($width)
    {
        $this->params['width'] = $width; // Set the width parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the height of the message.
     *
     * @param int $height The height of the message.
     * @return $this Returns the current instance with the height set.
     */
    private function setHeight($height)
    {
        $this->params['height'] = $height; // Set the height parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set whether the message supports streaming.
     *
     * @param bool $supports_streaming A boolean value indicating whether the message supports streaming.
     * @return $this Returns the current instance with the flag set.
     */
    private function setSupportsStreaming($supports_streaming)
    {
        $this->params['supports_streaming'] = $supports_streaming; // Set the supports_streaming parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the animation for the message.
     *
     * @param mixed $animation The animation for the message.
     * @return $this Returns the current instance with the animation set.
     */
    private function setAnimation($animation)
    {
        $this->params['animation'] = $animation; // Set the animation parameter.
        return $this; // Return the current instance.
    }

    /**
     * Set the voice for the message.
     *
     * @param mixed $voice The voice to set.
     * @return $this Returns the current instance with the voice set.
     */
    private function setVoice($voice)
    {
        // Set the voice parameter.
        $this->params['voice'] = $voice;
        // Return the current instance.
        return $this;
    }

    /**
     * Set the message effect ID for the message.
     *
     * @param mixed $message_effect_id The message effect ID to set.
     * @return $this Returns the current instance with the message effect ID set.
     */
    private function setMessageEffectId($message_effect_id)
    {
        // Set the message effect ID parameter.
        $this->params['message_effect_id'] = $message_effect_id;
        // Return the current instance.
        return $this;
    }

    /**
     * Set the length for the message.
     *
     * @param mixed $length The length to set.
     * @return $this Returns the current instance with the length set.
     */
    private function setLength($length)
    {
        // Set the length parameter.
        $this->params['length'] = $length;
        // Return the current instance.
        return $this;
    }

    /**
     * Set the video note for the message.
     *
     * @param mixed $video_note The video note to set.
     * @return $this Returns the current instance with the video note set.
     */
    private function setVideoNote($video_note)
    {
        // Set the video note parameter.
        $this->params['video_note'] = $video_note;
        // Return the current instance.
        return $this;
    }

    /**
     * Set the allow paid broadcast flag for the message.
     *
     * @param mixed $allow_paid_broadcast The flag to allow or disallow paid broadcasts.
     * @return $this Returns the current instance with the allow paid broadcast flag set.
     */
    private function setAllowPaidBroadcast($allow_paid_broadcast)
    {
        // Set the allow paid broadcast parameter.
        $this->params['allow_paid_broadcast'] = $allow_paid_broadcast;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the star count for the message.
     *
     * @param mixed $star_count The number of stars to set.
     * @return $this Returns the current instance with the star count set.
     */
    private function setStarCount($star_count)
    {
        // Set the star count parameter.
        $this->params['star_count'] = $star_count;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the media for the message.
     *
     * @param mixed $media The media to set for the message.
     * @return $this Returns the current instance with the media set.
     */
    private function setMedia($media)
    {
        // Set the media parameter.
        $this->params['media'] = $media;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the payload for the message.
     *
     * @param mixed $payload The payload to set for the message.
     * @return $this Returns the current instance with the payload set.
     */
    private function setPayload($payload)
    {
        // Set the payload parameter.
        $this->params['payload'] = $payload;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set whether to show the caption above the media for the message.
     *
     * @param mixed $show_caption_above_media Whether to show the caption above the media.
     * @return $this Returns the current instance with the show_caption_above_media flag set.
     */
    private function setShowCaptionAboveMedia($show_caption_above_media)
    {
        // Set the show_caption_above_media parameter.
        $this->params['show_caption_above_media'] = $show_caption_above_media;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the latitude for the message.
     *
     * @param mixed $latitude The latitude value to set.
     * @return $this Returns the current instance with the latitude set.
     */
    private function setLatitude($latitude)
    {
        // Set the latitude parameter.
        $this->params['latitude'] = $latitude;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the longitude for the message.
     *
     * @param mixed $longitude The longitude value to set.
     * @return $this Returns the current instance with the longitude set.
     */
    private function setLongitude($longitude)
    {
        // Set the longitude parameter.
        $this->params['longitude'] = $longitude;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the horizontal accuracy for the message.
     *
     * @param mixed $horizontal_accuracy The horizontal accuracy value to set.
     * @return $this Returns the current instance with the horizontal accuracy set.
     */
    private function setHorizontalAccuracy($horizontal_accuracy)
    {
        // Set the horizontal accuracy parameter.
        $this->params['horizontal_accuracy'] = $horizontal_accuracy;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the live period for the message.
     *
     * @param mixed $live_period The live period value to set.
     * @return $this Returns the current instance with the live period set.
     */
    private function setLivePeriod($live_period)
    {
        // Set the live period parameter.
        $this->params['live_period'] = $live_period;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the heading for the message.
     *
     * @param mixed $heading The heading value to set.
     * @return $this Returns the current instance with the heading set.
     */
    private function setHeading($heading)
    {
        // Set the heading parameter.
        $this->params['heading'] = $heading;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the proximity alert radius for the message.
     *
     * @param mixed $proximity_alert_radius The proximity alert radius value to set.
     * @return $this Returns the current instance with the proximity alert radius set.
     */
    private function setProximityAlertRadius($proximity_alert_radius)
    {
        // Set the proximity alert radius parameter.
        $this->params['proximity_alert_radius'] = $proximity_alert_radius;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the address for the message.
     *
     * @param mixed $address The address value to set.
     * @return $this Returns the current instance with the address set.
     */
    private function setAddress($address)
    {
        // Set the address parameter.
        $this->params['address'] = $address;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the Foursquare ID for the message.
     *
     * @param mixed $foursquare_id The Foursquare ID value to set.
     * @return $this Returns the current instance with the Foursquare ID set.
     */
    private function setFoursquareId($foursquare_id)
    {
        // Set the Foursquare ID parameter.
        $this->params['foursquare_id'] = $foursquare_id;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the Foursquare type for the message.
     *
     * @param mixed $foursquare_type The Foursquare type value to set.
     * @return $this Returns the current instance with the Foursquare type set.
     */
    private function setFoursquareType($foursquare_type)
    {
        // Set the Foursquare type parameter.
        $this->params['foursquare_type'] = $foursquare_type;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the Google Place ID for the message.
     *
     * @param mixed $google_place_id The Google Place ID value to set.
     * @return $this Returns the current instance with the Google Place ID set.
     */
    private function setGooglePlaceId($google_place_id)
    {
        // Set the Google Place ID parameter.
        $this->params['google_place_id'] = $google_place_id;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the Google Place type for the message.
     *
     * @param mixed $google_place_type The Google Place type value to set.
     * @return $this Returns the current instance with the Google Place type set.
     */
    private function setGooglePlaceType($google_place_type)
    {
        // Set the Google Place type parameter.
        $this->params['google_place_type'] = $google_place_type;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the phone number for the message.
     *
     * @param mixed $phone_number The phone number value to set.
     * @return $this Returns the current instance with the phone number set.
     */
    private function setPhoneNumber($phone_number)
    {
        // Set the phone number parameter.
        $this->params['phone_number'] = $phone_number;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the first name for the message.
     *
     * @param mixed $first_name The first name value to set.
     * @return $this Returns the current instance with the first name set.
     */
    private function setFirstName($first_name)
    {
        // Set the first name parameter.
        $this->params['first_name'] = $first_name;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the last name for the message.
     *
     * @param mixed $last_name The last name value to set.
     * @return $this Returns the current instance with the last name set.
     */
    private function setLastName($last_name)
    {
        // Set the last name parameter.
        $this->params['last_name'] = $last_name;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the vCard for the message.
     *
     * @param mixed $vcard The vCard value to set.
     * @return $this Returns the current instance with the vCard set.
     */
    private function setVcard($vcard)
    {
        // Set the vCard parameter.
        $this->params['vcard'] = $vcard;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the question for the message.
     *
     * @param mixed $question The question value to set.
     * @return $this Returns the current instance with the question set.
     */
    private function setQuestion($question)
    {
        // Set the question parameter.
        $this->params['question'] = $question;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the question parse mode for the message.
     *
     * @param mixed $question_parse_mode The question parse mode value to set.
     * @return $this Returns the current instance with the question parse mode set.
     */
    private function setQuestionParseMode($question_parse_mode)
    {
        // Set the question parse mode parameter.
        $this->params['question_parse_mode'] = $question_parse_mode;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the question entities for the message.
     *
     * @param mixed $question_entities The question entities value to set.
     * @return $this Returns the current instance with the question entities set.
     */
    private function setQuestionEntities($question_entities)
    {
        // Set the question entities parameter.
        $this->params['question_entities'] = $question_entities;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the anonymity status for the message.
     *
     * @param mixed $is_anonymous The anonymity status value to set.
     * @return $this Returns the current instance with the anonymity status set.
     */
    private function setIsAnonymous($is_anonymous)
    {
        // Set the anonymity status parameter.
        $this->params['is_anonymous'] = $is_anonymous;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the multiple answers permission for the message.
     *
     * @param mixed $allows_multiple_answers The multiple answers permission value to set.
     * @return $this Returns the current instance with the multiple answers permission set.
     */
    private function setAllowsMultipleAnswers($allows_multiple_answers)
    {
        // Set the multiple answers permission parameter.
        $this->params['allows_multiple_answers'] = $allows_multiple_answers;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the correct option ID for the message.
     *
     * @param mixed $correct_option_id The correct option ID value to set.
     * @return $this Returns the current instance with the correct option ID set.
     */
    private function setCorrectOptionId($correct_option_id)
    {
        // Set the correct option ID parameter.
        $this->params['correct_option_id'] = $correct_option_id;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the explanation for the message.
     *
     * @param mixed $explanation The explanation value to set.
     * @return $this Returns the current instance with the explanation set.
     */
    private function setExplanation($explanation)
    {
        // Set the explanation parameter.
        $this->params['explanation'] = $explanation;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the explanation parse mode for the message.
     *
     * @param mixed $explanation_parse_mode The explanation parse mode value to set.
     * @return $this Returns the current instance with the explanation parse mode set.
     */
    private function setExplanationParseMode($explanation_parse_mode)
    {
        // Set the explanation parse mode parameter.
        $this->params['explanation_parse_mode'] = $explanation_parse_mode;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the explanation entities for the message.
     *
     * @param mixed $explanation_entities The explanation entities value to set.
     * @return $this Returns the current instance with the explanation entities set.
     */
    private function setExplanationEntities($explanation_entities)
    {
        // Set the explanation entities parameter.
        $this->params['explanation_entities'] = $explanation_entities;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the open period for the message.
     *
     * @param mixed $open_period The open period value to set.
     * @return $this Returns the current instance with the open period set.
     */
    private function setOpenPeriod($open_period)
    {
        // Set the open period parameter.
        $this->params['open_period'] = $open_period;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the close date for the message.
     *
     * @param mixed $close_date The close date value to set.
     * @return $this Returns the current instance with the close date set.
     */
    private function setCloseDate($close_date)
    {
        // Set the close date parameter.
        $this->params['close_date'] = $close_date;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the closed status for the message.
     *
     * @param mixed $is_closed The closed status value to set.
     * @return $this Returns the current instance with the closed status set.
     */
    private function setIsClosed($is_closed)
    {
        // Set the closed status parameter.
        $this->params['is_closed'] = $is_closed;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the emoji for the message.
     *
     * @param mixed $emoji The emoji value to set.
     * @return $this Returns the current instance with the emoji set.
     */
    private function setEmoji($emoji)
    {
        // Set the emoji parameter.
        $this->params['emoji'] = $emoji;
        // Return the current instance for method chaining.
        return $this;
    }

    /**
     * Set the action for the message.
     *
     * @param mixed $action The action value to set.
     * @return $this Returns the current instance with the action set.
     */
    private function setAction($action)
    {
        // Set the action parameter.
        $this->params['action'] = $action;
        // Return the current instance for method chaining.
        return $this;
    }
}
