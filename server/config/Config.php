<?php

namespace base\config;

class Config
{
    const CREATOR_NAME = 'Jasper Lichte';

    const CREATOR_EMAIL = 'jasper@lichte.info';

    const CREATOR_GITHUB_URL = 'https://github.com/JasperLichte';

    const APP_NAME = 'Jasper Lichte';

    const BG_ANIMATION = false;

    const COLOR_ANIMATION = false;

    const COLOR_ANIMATION_DELAY = 20000;

    const PRODUCTION = false;

    const VERSION = '0.1.0';

    const DEFAULT_LANGUAGE = 'en';

    const SUPPORTED_LANGUAGES = ['en', 'de', 'es', 'fr'];

    const REPO_URL = 'https://github.com/JasperLichte/personal-website';

    private static $absRootDir = '';

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
        return (self::PRODUCTION
            ? self::SCRIPTS_ROOT_DIR() . 'bundle.js'
            : self::ABS_ROOT_DIR() . 'build/app.js');
    }

    /**
     * @return string
     */
    public static function MAIN_JS_FILE_TYPE()
    {
        return (self::PRODUCTION
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
     * @return array
     */
    public static function getConfArray()
    {
        $arr = [
            'APP_NAME'              => [
                'type'  => 'string',
                'value' => self::APP_NAME,
            ],
            'COLOR_ANIMATION'       => [
                'type'  => 'bool',
                'value' => self::COLOR_ANIMATION,
            ],
            'COLOR_ANIMATION_DELAY' => [
                'type'  => 'int',
                'value' => self::COLOR_ANIMATION_DELAY,
            ],
            'BG_ANIMATION'          => [
                'type'  => 'bool',
                'value' => self::BG_ANIMATION,
            ],
            'PRODUCTION'            => [
                'type'  => 'bool',
                'value' => self::PRODUCTION,
            ],
            'REPO_URL'              => [
                'type'  => 'string',
                'value' => self::REPO_URL,
            ],
            'VERSION'               => [
                'type'  => 'string',
                'value' => self::VERSION,
            ],
            'ABS_ROOT_DIR'          => [
                'type'  => 'string',
                'value' => self::ABS_ROOT_DIR(),
            ],
        ];

        foreach ($arr as $key => $entry) {
            if (!isset($entry['type']) || !isset($entry['value'])) {
                unset($arr[$key]);
            }
            if (in_array($entry['type'], ['int', 'bool', 'boolean'])) {
                $arr[$key]['value'] = (int)$entry['value'];
            }
        }
        return $arr;
    }
}
