<?php

namespace templates\components\err404;

require_once __DIR__ . './../../HtmlHelper.php';
require_once __DIR__ . './../Component.php';

use templates\components\Component;
use templates\HtmlHelper;

class Err404 extends Component
{
    const ID = 'err404';
    const NAME = '404';
    const WITH_BG_CANVAS = true;

    /**
     * @return string
     */
    public static function build()
    {
        $html = [
            HtmlHelper::element(
                'h1',
                [],
                '404'
            )
        ];

        return parent::buildSkeleton(
            self::WITH_BG_CANVAS,
            implode('', $html)
        );
    }

}