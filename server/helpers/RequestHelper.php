<?php

namespace helpers;

use base\config\Config;
use database\Connection;
use database\QueryHelper;

require_once __DIR__ . './../base/base.php';

class RequestHelper
{

    /**
     * @return string
     */
    public static function getRequestIP() {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            return $client;
        }
        if (filter_var($forward, FILTER_VALIDATE_IP)) {
            return $forward;
        }
        return $remote;
    }

    /**
     * @return string
     */
    public static function getRequestLanguage() {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        return in_array($lang, Config::SUPPORTED_LANGUAGES)
            ? $lang
            : Config::get('DEFAULT_LANGUAGE');
    }

    /**
     * @return string
     */
    public static function getRequestPath()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return bool
     */
    public static function isLocalRequest()
    {
        return (
            strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
            || in_array($_SERVER['REMOTE_ADDR'], ['::1', '127.0.0.1'])
        );
    }

    /**
     * @return void
     */
    public static function saveRequest()
    {
        if (!self::isLocalRequest()) {
            QueryHelper::insertTablePairs(
                Connection::getInstance(),
                'requests',
                [
                    'ip' => '"' . self::getRequestIP() . '"',
                    'path' => '"' . self::getRequestPath() . '"',
                    'time' => 'NOW()',
                    'language' => '"' . self::getRequestLanguage() . '"'
                ]
            );
        }
    }

}