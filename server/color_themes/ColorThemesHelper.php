<?php

namespace color_themes;

use base\config\Config;
use database\Connection;
use database\QueryHelper;
use helpers\RequestHelper;
use templates\HtmlHelper;

require_once __DIR__ . './../base/base.php';

class ColorThemesHelper
{

    const BODY_BG = 'body-bg';
    const BG_CANVAS_FILTER = 'bg-canvas-filter';
    const BG_CANVAS_OPACITY = 'bg-canvas-opacity';
    const CONTENT_BG = 'content-bg-color';
    const CONTENT_FONT = 'content-font-color';
    const CONTENT_ACCENT_BG = 'content-accent-bg-color';
    const CONTENT_ACCENT_FONT = 'content-accent-font-color';
    const HEADER_BG = 'header-bg-color';
    const HEADER_FONT = 'header-font-color';
    const FOOTER_BG = 'footer-bg-color';
    const FOOTER_FONT = 'footer-font-color';

    /**
     * @param int $limit
     * @return array
     */
    public static function getThemes($limit = null)
    {
        return QueryHelper::getTableFields(
            Connection::getInstance(),
            'color_themes',
            ['id', 'name'],
            'theme_index >= 0',
            'theme_index, name',
            $limit
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

        if (!isset($theme[self::CONTENT_ACCENT_BG]) || empty($theme[self::CONTENT_ACCENT_BG])) {
            $theme[self::CONTENT_ACCENT_BG] = (isset($theme[self::HEADER_BG]) && !empty($theme[self::HEADER_BG])
                ? $theme[self::HEADER_BG] : '');
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
     * @return string
     */
    public static function buildThemesSectionHtml()
    {
        $html = [];
        foreach (self::getThemes(10) as $theme) {
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
