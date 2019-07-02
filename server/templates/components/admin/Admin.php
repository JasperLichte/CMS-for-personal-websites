<?php

namespace templates\components\admin;

require_once __DIR__ . './../../../base/base.php';
require_once __DIR__ . './../../HtmlHelper.php';
require_once __DIR__ . './../Component.php';
require_once __DIR__ . './../../../api/helpers/ValueNames.php';
require_once __DIR__ . './../../../color_themes/ColorThemesHelper.php';
require_once __DIR__ . './../../../bg_animations/BgAnimationsHelper.php';

use api\helpers\ValueNames;
use base\config\Config;
use bg_animations\BgAnimationsHelper;
use color_themes\ColorThemesHelper;
use helpers\RequestHelper;
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
            self::buildField(
                'settings',
                self::buildSettingsForm(self::buildSettingsInputs())
            ),
            self::buildField(
                'requests',
                self::buildRequestsTable()
            ),
        ];

        return parent::buildSkeleton(
            self::WITH_BG_CANVAS,
            implode('', $html)
        );
    }

    /**
     * @param string $id
     * @param string $html
     * @return string
     */
    private static function buildField($id = '', $html = '')
    {
        return HtmlHelper::element(
            'div',
            [
                'id' => $id,
                'class' => 'field',
            ],
            $html
        );
    }

    /**
     * @param string $html
     * @return string
     */
    private static function buildSettingsForm($html = '')
    {
        return HtmlHelper::form(
            Config::API_ROOT_DIR() . 'admin/settings.php',
            'POST',
            $html
        );
    }

    /**
     * @return string
     */
    private static function buildSettingsInputs()
    {
        $inputs = [];

        $inputs[] = self::buildColorThemeInput();
        $inputs[] = self::buildBgAnimationInput();

        $inputs[] = HtmlHelper::input(
            'submit',
            ['value' => 'Submit!']
        );

        return implode('', $inputs);
    }

    /**
     * @return string
     */
    private static function buildRequestsTable()
    {
        $requests = RequestHelper::getRequests(50);

        $rows = [];
        foreach ($requests as $request) {
            $cells = [
                HtmlHelper::element('td', [], $request['ip']),
                HtmlHelper::element('td', [], $request['path']),
                HtmlHelper::element('td', [], $request['time']),
                HtmlHelper::element('td', [], $request['language']),
            ];

            $rows[] = HtmlHelper::element(
                'tr',
                [],
                implode('', $cells)
            );
        }
        return HtmlHelper::element(
            'table',
            [],
            HtmlHelper::element('thead', [], HtmlHelper::element('tr', [], implode('', [
                HtmlHelper::element('th', [], 'IP'),
                HtmlHelper::element('th', [], 'Path'),
                HtmlHelper::element('th', [], 'Time'),
                HtmlHelper::element('th', [], 'Language'),
            ]))) .
            HtmlHelper::element('tbody', [], implode('', $rows))
        );
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
            Config::get('DEFAULT_COLOR_THEME')
        );
    }

    /**
     * @return string
     */
    private static function buildBgAnimationInput()
    {
        $selectOptions = [];
        foreach (BgAnimationsHelper::getAnimations() as $animation) {
            $selectOptions[] = [
                'val' => (int)$animation['id'],
                'desc' => $animation['name'],
            ];
        }
        $selectOptions[] = [
            'val' => 0,
            'desc' => 'None',
        ];

        return HtmlHelper::selectInput(
            ValueNames::BG_ANIMATION_BOOL,
            [],
            [
                [
                    'val' => 1,
                    'desc' => 'Rain',
                ],
                [
                    'val' => 2,
                    'desc' => 'Wandering Circles',
                ],
                [
                    'val' => 0,
                    'desc' => 'None',
                ],
            ],
            Config::get('DEFAULT_BG_ANIMATION')
        );
    }

}
