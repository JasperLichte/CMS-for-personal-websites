<?php

namespace templates\components;

use base\config\Config;
use templates\HtmlHelper;

require_once __DIR__ . './../../base/base.php';

class Component
{
    const ID = '';

    const NAME = '';

    const NEEDED_CSS_FILES = ['bundle.css'];

    const NEEDED_JS_FILES = [];

    const WITH_BG_CANVAS = true;

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

    /**
     * @param bool $withCanvas
     * @param string $html
     * @return string
     */
    protected static function buildSkeleton($withCanvas = self::WITH_BG_CANVAS, $html)
    {
        return
            (HtmlHelper::element(
                    'div',
                    ['id' => 'page'],
                    HtmlHelper::element(
                        'main',
                        [],
                        $html
                    )
                ) . (
                $withCanvas
                    ? HtmlHelper::element(
                        'canvas',
                        ['id' => 'bg-canvas']
                    )
                    : ''
                )
            );
    }

}