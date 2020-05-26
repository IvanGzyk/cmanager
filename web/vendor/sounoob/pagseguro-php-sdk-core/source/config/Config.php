<?php

namespace Sounoob\pagseguro\config;

use Exception;
use InvalidArgumentException;

/**
 * Class Config
 * @package Sounoob\pagseguro\config
 */
class Config
{
    /**
     * @var bool
     */
    private static $sandbox = null;
    /**
     * @var string
     */
    private static $email = 'ivangzyk@gmail.com';
    /**
     * @var string
     */
    //private static $token = "710e1100-a3a1-4df1-b952-535ff57d0ae1cb1bd94a4da2a1c4c4a90bde3a7fca2634ee-bbe7-4f76-ab31-4bcd60ed0287";
    private static $token = "6EC03CE1480B42FC8AE980E1A83BB255";

    /**
     * @return string
     */
    public static function getEmail()
    {
        return self::$email;
    }

    /**
     * @return string
     */
    public static function getToken()
    {
        return self::$token;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public static function isSandbox()
    {
        if (self::$sandbox === null) {
            Discover::detect_env();
        }
        return self::$sandbox;
    }

    /**
     * @deprecated
     */
    public static function setSandbox()
    {
        self::$sandbox = true;
    }

    /**
     * @deprecated
     */
    public static function setProduction()
    {
        self::$sandbox = false;
    }

    /**
     * @param string $email
     * @param string $token
     */
    public static function setAccountCredentials($email, $token)
    {
        if (self::$sandbox !== null) {
            throw new InvalidArgumentException('The e-mail and token was already defined before');
        }
        self::$email = $email;
        self::$token = $token;
    }
}

