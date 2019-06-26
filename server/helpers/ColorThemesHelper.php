<?php

namespace helpers;

use base\config\Config;
use database\Connection;
use database\QueryHelper;
use templates\HtmlHelper;

require_once __DIR__ . './../base/base.php';

class ColorThemesHelper
{

    /**
     * @return array
     */
    public static function getThemes()
    {
        return QueryHelper::getTableFields(
            Connection::getInstance(),
            'color_themes',
            ['id', 'name'],
            'theme_index >= 0',
            'theme_index, name'
        ) ?: [];
    }

    /**
     * @return array
     */
    public static function getDefaultThemeValues()
    {
        return self::getThemeValuesById(Config::get('DEFAULT_COLOR_THEME'));
    }

    /**
     * @param $id
     * @return array
     */
    public static function getThemeValuesById($id)
    {
        $id = (int)$id;
        if (!$id) {
            return [];
        }
        $res =  QueryHelper::getTableFields(
            Connection::getInstance(),
            'color_themes CT' .
            ' INNER JOIN color_themes_values CTV' .
            ' ON CT.id = CTV.theme_id',
            ['CTV.var_name', 'CTV.value'],
            'CT.id = ' . $id . ''
        )?:[];

        $theme = [];
        foreach ($res as $set) {
            $theme[$set['var_name']] = $set['value'];
        }

        if (!isset($theme['content-accent-bg-color']) || empty($theme['content-accent-bg-color'])) {
            $theme['content-accent-bg-color'] = (isset($theme['header-bg-color']) && !empty($theme['header-bg-color'])
                ? $theme['header-bg-color'] : '');
        }

        return $theme;
    }

    /**
     * @return array
     */
    public static function getThemeValuesForIp()
    {
        $ip = RequestHelper::getRequestIP();
        $themeId = (int)QueryHelper::getTableFieldElement(
            Connection::getInstance(),
            'color_themes_ip',
            'colorThemeId',
            'ip = "' . $ip . '"'
        );
        if ($themeId) {
            return self::getThemeValuesById($themeId);
        }
        return self::getDefaultThemeValues();
    }

    /**
     * @param array $theme
     * @return string
     */
    public static function getThemeInlineStyles($theme = [])
    {
        $strings = [];
        foreach ($theme as $varName => $value) {
            if (!isset($varName) || !isset($value) || !$varName || !$value) {
                continue;
            }
            $strings[] = '--' . $varName . ': ' . $value . ';';
        }
        return implode('', $strings);
    }

    /**
     *
     */
    public static function buildThemesSectionHtml()
    {
        $html = [];
        foreach (self::getThemes() as $theme) {
            $html[] = HtmlHelper::element(
                'button',
                [
                    'class' => 'color-theme-button',
                    'data-theme-id' => (int)$theme['id']
                ],
                $theme['name']
            );
        }
        $html[] = HtmlHelper::element(
            'button',
            [
                'class' => 'color-theme-button',
                'id' => 'reset',
                'data-theme-id' => 0,
            ],
            'Reset to default'
        );
        return implode('', $html);
    }

}
