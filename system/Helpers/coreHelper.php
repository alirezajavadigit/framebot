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
| system/Helpers/coreHelper.php
|--------------------------------------------------------------------------
| The provided functions offer crucial utilities: protocol() determines the 
| HTTP protocol (http:// or https://), currentDomain() retrieves the current
| domain, dd($var) dumps a variable for debugging, and env($name) fetches 
| environment variable values. They enhance framework functionality and aid 
| in debugging and environment variable management.
|--------------------------------------------------------------------------
*/

/**
 * Returns the protocol used for the current request.
 *
 * This function retrieves the protocol used for the current HTTP request
 * by examining the 'SERVER_PROTOCOL' server variable. It checks if the
 * protocol contains 'https', returning 'https://' if true, otherwise 'http://'.
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
 * This function retrieves the current domain based on the HTTP request
 * by concatenating the protocol and the host from the 'SERVER_PROTOCOL' and
 * 'HTTP_HOST' server variables, respectively.
 *
 * @return string The current domain
 */
function currentDomain()
{
    // Concatenate the protocol and the host from the server variables
    return protocol() . $_SERVER['HTTP_HOST'];
}

/**
 * Dumps a variable and ends execution.
 *
 * This function dumps a variable using var_dump() wrapped in <pre> tags
 * for better readability, and then exits the script.
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
 * Retrieves the value of an environment variable.
 *
 * This function retrieves the value of the specified environment variable.
 *
 * @param string $name The name of the environment variable
 * @return mixed The value of the environment variable
 */
function env($name)
{
    return $_ENV[$name];
}

/**
 * Converts Persian and Arabic numerals in a string to English numerals.
 *
 * This function replaces Persian and Arabic numerals in the input string
 * with their corresponding English numerals (0-9).
 *
 * @param string $string The string containing Persian or Arabic numerals
 * @return string The string with Persian and Arabic numerals converted to English
 */
function persianNumbersToEnglish($string)
{
    // Arrays of Persian and Arabic numerals
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    // English numerals (0-9)
    $num = range(0, 9);

    // Replace Persian numerals with English numerals
    $convertedPersianNums = str_replace($persian, $num, $string);

    // Replace Arabic numerals with English numerals
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $englishNumbersOnly;
}
