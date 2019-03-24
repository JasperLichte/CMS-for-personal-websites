<?php

namespace templates\components\err404;

require_once __DIR__ . './../../HtmlHelper.php';
require_once __DIR__ . './../Component.php';

use templates\components\Component;
use templates\HtmlHelper;

class Err404 extends Component
{
    const NAME = '404';

    /**
     * @return string
     */
    public static function build()
    {
        $html = [
            HtmlHelper::element(
                'h1',
                [
                    'style' => 'font-size: 91px; color: #222;',
                ],
                '404'
            )
        ];

        return HtmlHelper::element(
            'main',
            [
                'style' => 'height: 100vh;
                            width: 100vw;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            flex-direction: column;',
            ],
            implode('', $html)
        );
    }

}