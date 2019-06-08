<?php

namespace helpers;

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
     * @return int
     */
    public static function getActiveThemeId() {
        $result = QueryHelper::getTableFieldsElement(
            Connection::getInstance(),
            'settings',
            ['value'],
            'name = "DEFAULT_COLOR_THEME"'
        );
        return (isset($result['value']) ? (int)$result['value'] : 0);
    }

}
