<?php

/*
|--------------------------------------------------------------------------
| Framebot
|--------------------------------------------------------------------------
| PHP framework for Telegram bot development. Fast, flexible, feature-rich.
|--------------------------------------------------------------------------
| @category  Framework
| @framework Framebot
| @version   2.3.0
| @author    Alireza Javadi
| @license   MIT License
| @link      https://github.com/alirezajavadigit/framebot
|--------------------------------------------------------------------------
| System\TeleCore\Traits\Request
|--------------------------------------------------------------------------
| This trait provides functionality for making HTTP requests.
|--------------------------------------------------------------------------
*/

namespace System\TeleCore\Traits;

use GuzzleHttp\Client;

trait Request
{
    /**
     * Make an HTTP request.
     *
     * @param string $method     The HTTP method (GET, POST, PUT, DELETE, etc.).
     * @param array  $parameters The request parameters.
     *
     * @return mixed The response from the API.
     */
    private function request($method, $parameters)
    {
        // Initialize Guzzle client
        $client = new Client(['base_uri' => API_URL]);

        // Set empty parameters array if none provided
        if (!$parameters) {
            $parameters = [];
        }
        // Add the method to the parameters
        $parameters["method"] = $method;

        // Send POST request with JSON-encoded parameters
        $response = $client->post('', [
            'json' => $parameters,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'connect_timeout' => 5, // Timeout for connection
            'timeout' => 60, // Timeout for execution
        ]);

        // Get response body
        $result = $response->getBody()->getContents();

        // Return the result
        return $result;
    }
}
