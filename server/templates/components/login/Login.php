<?php

namespace templates\components\login;

require_once __DIR__ . './../../../base/base.php';
require_once __DIR__ . './../Component.php';
require_once __DIR__ . './../../../api/helpers/ValueNames.php';
require_once __DIR__ . './../../../helpers/ColorThemesHelper.php';

use base\config\Config;
use templates\components\Component;
use templates\HtmlHelper;

class Login extends Component
{
    const ID = 'login';
    const NAME = 'Login';

    /**
     * @return string
     */
    public static function build()
    {
        return parent::buildSkeleton(self::WITH_BG_CANVAS, self::buildForm());
    }

    /**
     * @param string $inputsHtml
     * @return string
     */
    private static function buildForm()
    {
        $inputsHtml = '';
        return HtmlHelper::form(
            Config::API_ROOT_DIR() . 'users/login.php',
            'POST',
            $inputsHtml
        );
    }

}
