<?php

/**
 * Returns the protocol used for the current request.
 *
 * @return string The protocol (http:// or https://)
 */
function protocol()
{
    // Check if the server protocol contains 'https'
    return stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
}

/**
 * Returns the current domain based on the request.
 *
 * @return string The current domain
 */
function currentDomain()
{
    // Concatenate the protocol and the host from the server variables
    return protocol() . $_SERVER['HTTP_HOST'];
}

/**
 * Sends a request to the Telegram API and returns the result.
 *
 * @param string $method The method to call
 * @param array $parameters The parameters to pass to the method
 * @return mixed The result of the API call
 */
function messageRequestJson($method, $parameters)
{
    // Set empty parameters array if none provided
    if (!$parameters) {
        $parameters = array();
    }
    // Add the method to the parameters
    $parameters["method"] = $method;

    // Initialize cURL handle
    $handle = curl_init(API_URL);
    // Set cURL options
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5); // Timeout for connection
    curl_setopt($handle, CURLOPT_TIMEOUT, 60); // Timeout for execution
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters)); // Set POST fields
    curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); // Set request headers
    // Execute cURL request and store the result
    $result = curl_exec($handle);
    // Return the result
    return $result;
}

/**
 * Dumps a variable and ends execution.
 *
 * @param mixed $var The variable to dump
 */
function dd($var)
{
    // Dump the variable and exit
    echo '<pre>';
    var_dump($var);
    exit;
}

/**
 * Generates a random token of specified length.
 *
 * @param int $length The length of the token
 * @return string The generated token
 */
function getToken($length)
{
    // Function to generate a cryptographically secure random number in a given range
    function crypto_rand_secure($min, $max)
    {
        // Calculate range and bits required
        $range = $max - $min;
        if ($range < 1)
            return $min;
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1;
        $bits = (int) $log + 1;
        $filter = (int) (1 << $bits) - 1;
        // Generate random number until it falls within range
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;
        } while ($rnd > $range);
        // Return the random number within range
        return $min + $rnd;
    }

    // Define character set for token generation
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $max = strlen($codeAlphabet);

    // Generate token of specified length
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    // Return the generated token
    return $token;
}

/**
 * Validates an Iranian national code (Melli Code).
 *
 * @param string $value The national code to validate
 * @return bool True if the national code is valid, false otherwise
 */
function IsNationalCode(string $value): bool
{
    // Validation rules for the national code
    if (
        preg_match('/^\d{8,10}$/', $value) == false ||
        preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)
    ) {
        return false;
    }

    // Calculate the control digit
    $sub = 0;
    switch (strlen($value)) {
        case 8:
            $value = '00' . $value;
            break;
        case 9:
            $value = '0' . $value;
            break;
    }
    for ($i = 0; $i <= 8; $i++) {
        $sub = $sub + ($value[$i] * (10 - $i));
    }
    $control = ($sub % 11) < 2 ? $sub % 11 : 11 - ($sub % 11);

    // Check if the control digit matches the last digit of the national code
    return $value[9] == $control ? true : false;
}

/**
 * Converts Persian numbers in a string to English numbers.
 *
 * @param string $string The string containing Persian numbers
 * @return string The string with Persian numbers converted to English
 */
function persianNumbersToEnglish($string)
{
    // Define arrays for Persian and Arabic numbers
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $num = range(0, 9);

    // Replace Persian and Arabic numbers with English numbers
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    // Return the string with converted numbers
    return $englishNumbersOnly;
}

/**
 * Validates a cellphone number based on the Iranian format.
 *
 * @param string $number The cellphone number to validate
 * @return bool True if the cellphone number is valid, false otherwise
 */
function IsCellphone(string $number): bool
{
    // Check if the number matches the Iranian cellphone format
    return (bool) preg_match('/^(^(0){1}[0-9]{10})+$/', $number);
}

/**
 * Sends an SMS using the IPPanel service.
 *
 * @param string $sms The message to send
 * @param string $phoneNumber The recipient's phone number
 * @return mixed The result of the SMS sending operation
 */
function sendSms($sms, $phoneNumber)
{
    // Initialize SOAP client with IPPanel service WSDL
    $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
    // IPPanel credentials and message details
    $user = "";
    $pass = "";
    $fromNum = "+9850002040000000";
    $toNum = array(substr($phoneNumber, 1));
    $pattern_code = "atvapnfepxg09tz";
    $input_data = array("secondPassword" => $sms);

    // Send pattern SMS and return the result
    return $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}
