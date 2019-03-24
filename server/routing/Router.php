<?php

namespace routing;

require_once __DIR__ . './../templates/components/home/Home.php';
require_once __DIR__ . './../templates/components/err404/Err404.php';

use templates\components\Component;
use templates\components\err404\Err404;
use templates\components\home\Home;

class Router
{

    /**
     * @return Component
     */
    public static function getComponentByRequest()
    {
        $pageName = (isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : '');

        switch (strtolower($pageName)) {
            case 'home':
            case '':
                return new Home();
            default:
                return new Err404();
        }
    }

}