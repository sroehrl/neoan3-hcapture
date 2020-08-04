<?php

namespace Neoan3\Apps;

use Exception;

class Hcapture
{
    private static $secret;
    private static $apiKey = false;
    private static $siteKey = false;
    public static $clientResponse;
    private static $remoteIp = false;

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
     * @param array $input
     *
     * @return mixed
     * @throws Exception
     */
    static function isHuman($input=[])
    {
        self::getPost($input);
        $call = [
            'secret=' . self::$secret,
            'response=' . self::$clientResponse
        ];
        if(self::$remoteIp){
            $call[] = 'remoteip=' . self::$remoteIp;
        }
        $check = Curl::post('https://hcaptcha.com/siteverify?'.implode('&',$call), []);
        return $check['success'];
    }

    static function stats()
    {
        $call = 'https://hcaptcha.com/user/sitekey/'.self::$siteKey.'/stats?api_key=' .self::$apiKey;
        return json_decode(file_get_contents($call),true);

    }

    /**
     * @param array $input
     *
     * @throws Exception
     */
    private static function getPost($input=[])
    {
        if(isset($input['h-captcha-response'])){
            self::$clientResponse = $input['h-captcha-response'];
        } elseif (isset($_POST['h-captcha-response'])) {
            self::$clientResponse = $_POST['h-captcha-response'];
        } else {
            throw new Exception('Missing h-captcha');
        }
        if (isset($_SERVER['REMOTE_ADDR'])) {
            self::$remoteIp = $_SERVER['REMOTE_ADDR'];
        }
    }
}