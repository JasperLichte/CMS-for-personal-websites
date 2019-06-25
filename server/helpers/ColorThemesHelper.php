<?php

namespace helpers;

use base\config\Config;
use database\Connection;
use database\QueryHelper;

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
            ['id', 'name']
        ) ?: [];
    }

    /**
     * @return array
     */
    public static function getDefaultThemeValues()
    {
        $res =  QueryHelper::getTableFields(
            Connection::getInstance(),
            'color_themes CT' .
            ' INNER JOIN color_themes_values CTV' .
            ' ON CT.id = CTV.theme_id',
            ['CTV.var_name', 'CTV.value'],
            'CT.id = ' . (int)Config::get('DEFAULT_COLOR_THEME') . ''
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

}
