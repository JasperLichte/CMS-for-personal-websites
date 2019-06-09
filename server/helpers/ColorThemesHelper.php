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
        $defaultThemeId = (int)Config::get('DEFAULT_COLOR_THEME');

        $db = Connection::getInstance();
        return QueryHelper::getTableFields(
            $db,
            'color_themes CT' .
            ' INNER JOIN color_themes_values CTV' .
            ' ON CT.id = CTV.theme_id',
            ['CTV.var_name', 'CTV.value'],
            'CT.id = ' . $defaultThemeId . ''
        )?:[];
    }

    /**
     * @param array $theme
     * @return string
     */
    public static function getThemeInlineStyles($theme = [])
    {
        $strings = [];
        foreach ($theme as $color) {
            if (!isset($color['var_name']) || !isset($color['value']) || !$color['var_name'] || !$color['value']) {
                continue;
            }
            $strings[] = '--' . $color['var_name'] . ': ' . $color['value'] . ';';
        }
        return implode('', $strings);
    }

}
