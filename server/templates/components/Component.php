<?php

namespace templates\components;

class Component
{
    const ID = '';

    const NAME = '';

    const NEEDED_CSS_FILES = ['bundle.css'];

    const NEEDED_JS_FILES = [];

    public static function MAIN_JS_FILE() {
        return '';
    }

    /**
     * @return string
     */
    public static function build()
    {
        return '';
    }

}