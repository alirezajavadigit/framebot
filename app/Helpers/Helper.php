<?php

function protocol()
{
        return stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
}
function currentDomain()
{
        return protocol() . $_SERVER['HTTP_HOST'];
}
// sending request with method and parameters to telegram api
function messageRequestJson($method, $parameters)
{
        if (!$parameters) {
                $parameters = array();
        }
        $parameters["method"] = $method;
        $handle = curl_init(API_URL);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($handle, CURLOPT_TIMEOUT, 60);
        curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $result = curl_exec($handle);
        return $result;
}
function dd($var)
{
        echo '<pre>';
        var_dump($var);
        exit;
}

// return random token 
function getToken($length)
{
    function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1)
            return $min;
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1;
        $bits = (int) $log + 1;
        $filter = (int) (1 << $bits) - 1;
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;
        } while ($rnd > $range);
        return $min + $rnd;
    }
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    $max = strlen($codeAlphabet);

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, $max - 1)];
    }

    return $token;
}


// checking bank shabacode
function IsIban(string $value): bool
{
    if (empty($value)) {
        return false;
    }

    $ibanReplaceValues = [];
    $value = preg_replace('/[\W_]+/', '', strtoupper($value));
    if ((4 > strlen($value) || strlen($value) > 34) || (is_numeric($value[0]) || is_numeric($value[1])) || (!is_numeric($value[2]) || !is_numeric($value[3]))) {
        return false;
    }

    $ibanReplaceChars = range('A', 'Z');
    foreach (range(10, 35) as $tempvalue) {
        $ibanReplaceValues[] = strval($tempvalue);
    }

    $tmpIBAN = substr($value, 4) . substr($value, 0, 4);
    $tmpIBAN = str_replace($ibanReplaceChars, $ibanReplaceValues, $tmpIBAN);
    $tmpValue = intval(substr($tmpIBAN, 0, 1));
    for ($i = 1; $i < strlen($tmpIBAN); $i++) {
        $tmpValue *= 10;
        $tmpValue += intval(substr($tmpIBAN, $i, 1));
        $tmpValue %= 97;
    }

    return $tmpValue != 1 ? false : true;
}
//checking nationalcode
function IsNationalCode(string $value): bool
{
    if (
        preg_match('/^\d{8,10}$/', $value) == false ||
        preg_match('/^[0]{10}|[1]{10}|[2]{10}|[3]{10}|[4]{10}|[5]{10}|[6]{10}|[7]{10}|[8]{10}|[9]{10}$/', $value)
    ) {
        return false;
    }

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

    return $value[9] == $control ? true : false;
}

// changing persian and arabic numbers to english
function persianNumbersToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $englishNumbersOnly;
}


//checking is phone number valide
function IsCellphone(string $number): bool
{
    return (bool) preg_match('/^(^(0){1}[0-9]{10})+$/', $number);
}

// faraz sms send method
// return number if sms sended
function sendSms($sms, $phoneNumber)
{
    $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
    $user = "";
    $pass = "";
    $fromNum = "+9850002040000000";
    $toNum = array(substr($phoneNumber, 1));
    $pattern_code = "atvapnfepxg09tz";
    $input_data = array("secondPassword" => $sms);

    return $client->sendPatternSms($fromNum, $toNum, $user, $pass, $pattern_code, $input_data);
}
