<?php

namespace base\config;

use database\Connection;
use database\QueryHelper;
use helpers\RequestHelper;

require_once __DIR__ . './../base/base.php';

class Config
{
    private static $settings = [];
    private static $settingsLoaded = false;
    private static $absRootDir = '';

    const SUPPORTED_LANGUAGES = ['en', 'de', 'es', 'fr'];

    /**
     * @return string
     */
    public static function ABS_ROOT_DIR()
    {
        if (empty(self::$absRootDir)) {
            self::$absRootDir = getRootUrl();
        }
        return self::$absRootDir;
    }

    /**
     * @return string
     */
    public static function STYLES_ROOT_DIR()
    {
        return self::ABS_ROOT_DIR() . 'assets/styles/';
    }

    /**
     * @return string
     */
    public static function SCRIPTS_ROOT_DIR()
    {
        return self::ABS_ROOT_DIR() . 'assets/scripts/';
    }

    /**
     * @return string
     */
    public static function MAIN_JS_FILE()
    {
        return (self::PRODUCTION()
            ? self::SCRIPTS_ROOT_DIR() . 'bundle.js'
            : self::ABS_ROOT_DIR() . 'build/app.js');
    }

    /**
     * @return string
     */
    public static function MAIN_JS_FILE_TYPE()
    {
        return (self::PRODUCTION()
            ? 'text/javascript'
            : 'module');
    }

    /**
     * @return string
     */
    public static function MAIN_JS_FILE_IMPORT()
    {
        return '<script type="' . self::MAIN_JS_FILE_TYPE() . '" src="' . self::MAIN_JS_FILE() . '"></script>';
    }

    /**
     * @return string
     */
    public static function MEDIA_ROOT_URL()
    {
        return 'https://www.media.lichte.info/';
    }

    /**
     * @return string
     */
    public static function FAVICON_URL()
    {
        return self::MEDIA_ROOT_URL() . 'assets/favicon.ico';
    }

    /**
     * @return boolean
     */
    public static function PRODUCTION()
    {
        if (!RequestHelper::isLocalRequest()) {
            return true;
        }
        return self::get('PRODUCTION');
    }

    /**
     * @return void
     */
    private static function loadSettings()
    {
        $settings = QueryHelper::getTableFields(
            Connection::getInstance(),
            'settings',
            ['name', 'value', 'type']
        );

        foreach ($settings as $entry) {
            self::$settings[$entry['name']] = [
                'value' => $entry['value'],
                'type'  => self::parseSetting($entry['value'], $entry['type']),
            ];
        }
        self::$settingsLoaded = true;
    }

    /**
     * @param $value
     * @param string $type
     * @return bool|int
     */
    private static function parseSetting($value, $type)
    {
        switch ($type) {
            case 'bool':
            case 'boolean':
                return !!$value;
            case 'int':
                return (int)$value;
        }

    }

    /**
     * @param string $settingName
     * @return mixed
     */
    public static function get($settingName)
    {
        if (!self::$settingsLoaded) {
            self::loadSettings();
        }
        return (isset(self::$settings[$settingName])
            ? self::$settings[$settingName]['value']
            : null);
    }

    /**
     * @return array
     */
    public static function getConfArray()
    {
        if (!self::$settingsLoaded) {
            self::loadSettings();
        }

        $arr = [];
        foreach (self::$settings as $key => $entry) {
            if (in_array($entry['type'], ['bool', 'boolean'])) {
                $arr[$key]['value'] = (int)$entry['value'];
            }
        }
        return $arr;
    }
}
