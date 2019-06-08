<?php

namespace templates\components\admin;

require_once __DIR__ . './../../../base/base.php';
require_once __DIR__ . './../../HtmlHelper.php';
require_once __DIR__ . './../Component.php';
require_once __DIR__ . './../../../api/Helpers/ValueNames.php';
require_once __DIR__ . './../../../helpers/ColorThemesHelper.php';

use api\helpers\ValueNames;
use base\config\Config;
use helpers\ColorThemesHelper;
use templates\components\Component;
use templates\HtmlHelper;

class Admin extends Component
{
    const ID = 'admin';
    const NAME = 'Admin';

    /**
     * @return string
     */
    public static function build()
    {
        $html = [
            self::buildForm(self::buildInputs()),
        ];

        return HtmlHelper::element(
            'main',
            [],
            implode('', $html)
        );
    }

    /**
     * @param string $html
     * @return string
     */
    private static function buildForm($html = '')
    {
        return HtmlHelper::element(
            'form',
            [
                'method' => 'POST',
                'action' => Config::API_ROOT_DIR() . 'admin/settings.php'
            ],
            (is_string($html) ? $html : '')
        );
    }

    /**
     * @return string
     */
    private static function buildInputs()
    {
        $inputs = [];

        $inputs[] = self::buildColorThemeInput();

        $inputs[] = HtmlHelper::input(
            'submit',
            ['value' => 'Submit!']
        );

        return implode('', $inputs);
    }

    /**
     * @return string
     */
    private static function buildColorThemeInput()
    {
        $themes = ColorThemesHelper::getThemes();
        $options = [];

        foreach ($themes as $theme) {
            if (!isset($theme['name']) || !isset($theme['id'])) {
                continue;
            }
            $options[] = [
              'desc' => $theme['name'],
              'val'  => $theme['id'],
            ];
        }

        return HtmlHelper::selectInput(
            ValueNames::COLOR_THEME_ID,
            [],
            $options,
            ColorThemesHelper::getActiveThemeId()
        );
    }

}