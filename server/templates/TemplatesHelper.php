<?php

namespace templates;

use base\config\Config;
use helpers\RequestHelper;
use helpers\ColorThemesHelper;
use templates\components\Component;

require_once __DIR__ . './../base/base.php';
require_once __DIR__ . './../color_themes/ColorThemesHelper.php';

class TemplatesHelper
{

    const DOCTYPE = "<!DOCTYPE html>\n";
    const CHARSET = "UTF-8";

    /**
     * @return string
     */
    private static function metas()
    {
        return
            "<meta charset=\"" . self::CHARSET . "\">\n" .
            "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    }

    /**
     * @param array $files
     * @return string
     */
    private static function cssIncludes($files = [])
    {
        $html = '';
        foreach ($files as $file) {
            if (!is_string($file)) {
                continue;
            }
            $file = Config::STYLES_ROOT_DIR() . $file;
            $html .= "<link rel=\"stylesheet\" href=\"{$file}\">\n";
        }
        return $html;
    }

    /**
     * @param array $files
     * @return string
     */
    private static function jsIncludes($files = []) {
        $html = '';
        foreach ($files as $file => $fileType) {
            if (!is_string($file) || !is_string($fileType)) {
                continue;
            }
            $file = Config::SCRIPTS_ROOT_DIR() . $file;
            $html .= HtmlHelper::jsImport($file, $fileType);
        }
        return $html;
    }

    /**
     * @param string $fileSrc
     * @return string
     */
    private static function mainJsInclude($fileSrc) {
        if (!is_string($fileSrc) || !strlen($fileSrc)) {
            return '';
        }
        return HtmlHelper::jsImport($fileSrc, Config::MAIN_JS_FILE_TYPE());
    }

    /**
     * @return string
     */
    private static function inlineJs() {
        return HtmlHelper::script(
            "window.addEventListener('load', function() {
                document.body.classList.remove('preload')
            });" .
            self::copyRightConsoleLog() .
            "window.__CONF = '" . str_replace("'", '', \json_encode(Config::getConfArray())) . "';"
        );
    }

    /**
     * @return string
     */
    private static function copyRightComment()
    {
        return
            "\n<!--\n\n" .
            implode(self::copyRightContent(), "\n") .
            "\n\n-->\n\n";
    }

    /**
     * @return string
     */
    private static function copyRightConsoleLog()
    {
        return "console.info('" . implode('', self::copyRightContent()) . "');";
    }

    /**
     * @return array
     */
    private static function copyRightContent()
    {
        return [
            'This software belongs to: ',
            Config::get('CREATOR_NAME') . ' ',
            '(' . Config::get('CREATOR_EMAIL') . ')',
        ];
    }

    /**
     * @param Component $component
     * @return string
     */
    public static function getHtml(Component $component) {
        return
            self::DOCTYPE .
            self::copyRightComment() .
            HtmlHelper::element(
                'html',
                [
                    'lang'  => RequestHelper::getRequestLanguage(),
                    'style' => ColorThemesHelper::getThemeInlineStyles(
                        ColorThemesHelper::getThemeValuesForIp()
                    ),
                ],
                (
                    HtmlHelper::element(
                        'head',
                        [],
                        self::metas() .
                        HtmlHelper::title(self::getTitleByPageName($component::NAME)) .
                        self::cssIncludes($component::NEEDED_CSS_FILES) .
                        HtmlHelper::favicon(Config::get('FAVICON_URL'))
                    ) .
                    HtmlHelper::element(
                        'body',
                        [
                            'class' => 'preload',
                            'id'    => 'p-' . strtolower(str_replace(' ', '', $component::ID)),
                        ],
                        self::inlineJs() .
                        $component::build() .
                        self::jsIncludes($component::NEEDED_JS_FILES) .
                        self::mainJsInclude($component::MAIN_JS_FILE())
                    )
                )
            );
    }

    /**
     * @param string $page
     * @return string
     */
    public static function getTitleByPageName($page = '')
    {
        if (!Config::get('APP_NAME') || !strlen(Config::get('APP_NAME'))) {
            return $page;
        }
        if (!!strlen($page)) {
            return Config::get('APP_NAME') . ' | ' . $page;
        }
        return Config::get('APP_NAME');
    }

}
