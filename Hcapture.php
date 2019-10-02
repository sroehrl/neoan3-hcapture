<?php

namespace Neoan3\Apps;

use Exception;

class Hcapture
{
    private static $secret;
    private static $apiKey = false;
    private static $siteKey = false;
    private static $clientResponse;
    private static $remoteIpString = '';

    /**
     * @param $array
     */
    static function setEnvironment($array)
    {
        foreach ($array as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists(self::class,$method)){
                self::$method($value);
            }
        }
    }

    static function setSecret($secret)
    {
        self::$secret = $secret;
    }

    static function setApiKey($key)
    {
        self::$apiKey = $key;
    }

    static function setSiteKey($key)
    {
        self::$siteKey = $key;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    static function isHuman()
    {
        self::getPost();
        $call = 'https://hcaptcha.com/siteverify?secret=' . self::$secret . self::$remoteIpString;
        $call .= '&response=' . self::$clientResponse;
        $check = file_get_contents($call);
        $response = json_decode($check, true);
        return $response['success'];
    }

    static function stats()
    {
        $call = 'https://hcaptcha.com/user/sitekey/'.self::$siteKey.'/stats?api_key=' .self::$apiKey;
        try{
            $result = json_decode(file_get_contents($call),true);
            return $result;
        } catch (Exception $e) {
            return ['error' => 'rejected. Check variables'];
        }
    }

    /**
     * @throws Exception
     */
    private static function getPost()
    {
        if (isset($_POST['h-captcha-response'])) {
            self::$clientResponse = $_POST['h-captcha-response'];
        } else {
            throw new Exception('Missing h-captcha');
        }
        if (isset($_SERVER['REMOTE_ADDR'])) {
            self::$remoteIpString = '&remoteip=' . $_SERVER['REMOTE_ADDR'];
        }
    }
}