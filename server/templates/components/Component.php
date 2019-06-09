<?php

namespace templates\components;

use base\config\Config;

require_once __DIR__ . './../../base/base.php';

class Component
{
    const ID = '';

    const NAME = '';

    const NEEDED_CSS_FILES = ['bundle.css'];

    const NEEDED_JS_FILES = [];

    public static function MAIN_JS_FILE() {
        return Config::MAIN_JS_FILE();
    }

    /**
     * @return string
     */
    public static function build()
    {
        return '';
    }

}