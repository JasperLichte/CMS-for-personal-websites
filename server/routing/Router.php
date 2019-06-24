<?php

namespace routing;

require_once __DIR__ . './../templates/components/home/Home.php';
require_once __DIR__ . './../templates/components/err404/Err404.php';
require_once __DIR__ . './../templates/components/admin/Admin.php';
require_once __DIR__ . './../templates/components/login/Login.php';

use templates\components\Component;
use templates\components\err404\Err404;
use templates\components\home\Home;
use templates\components\admin\Admin;
use templates\components\login\Login;

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
            case 'admin':
                return new Admin();
            case 'login':
                return new Login();
            case '404':
            default:
                return new Err404();
        }
    }

}