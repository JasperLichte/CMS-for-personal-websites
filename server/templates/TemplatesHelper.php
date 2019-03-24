<?php

namespace templates;

use base\config\Config;

require_once __DIR__ . './../base/base.php';

class TemplatesHelper
{

    const DOCTYPE = "<!DOCTYPE html>\n";
    const CHARSET = "UTF-8";
    const HEAD_OPENING_TAG = "<head>\n";
    const HEAD_CLOSING_TAG = "</head>\n";
    const BODY_OPENING_TAG = "<body class=\"preload\">\n";
    const BODY_CLOSING_TAG = "</body>\n";
    const HTML_CLOSING_TAG = '</html>';

    /**
     * @param string $language
     * @return string
     */
    static function htmlOpeningTag($language = Config::DEFAULT_LANGUAGE)
    {
        return "<html lang=\"{$language}\">\n";
    }

    /**
     * @param string $title
     * @return string
     */
    static function title($title = '')
    {
        return "<title>{$title}</title>\n";
    }

    /**
     * @return string
     */
    static function metas()
    {
        return
            "<meta charset=\"" . self::CHARSET . "\">\n" .
            "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    }

    /**
     * @param string $url
     * @return string
     */
    static function favicon($url = '')
    {
        return '<link rel="icon" href="' . $url . '" type="image/x-icon" />';
    }

    /**
     * @param array $files
     * @return string
     */
    static function cssIncludes($files = [])
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
    static function jsIncludes($files = []) {
        $html = '';
        foreach ($files as $file => $fileType) {
            if (!is_string($file) || !is_string($fileType)) {
                continue;
            }
            $file = Config::SCRIPTS_ROOT_DIR() . $file;
            $html .= "<script type=\"" . $fileType . "\" src=\"{$file}\"></script>\n";
        }
        return $html;
    }

    /**
     * @param string $file
     * @return string
     */
    static function mainJsInclude($file) {
        if (!is_string($file) || !strlen($file)) {
            return '';
        }
        return "<script type=\"" . Config::MAIN_JS_FILE_TYPE() . "\" src=\"{$file}\"></script>\n";
    }

    /**
     * @return string
     */
    static function inlineJs() {
        return "" .
            "<script>" .
            "window.addEventListener('load', function() {
                document.body.classList.remove('preload')
            });" .
            self::copyRightConsoleLog() .
            "window.__CONF = '" . str_replace("'", '', \json_encode(Config::getConfArray())) . "';" .
            "</script>";
    }

    /**
     * @return string
     */
    static function copyRightComment()
    {
        return
            "\n<!--\n\n" .
            implode(self::copyRightContent(), "\n") .
            "\n\n-->\n\n";
    }

    /**
     * @return string
     */
    static function copyRightConsoleLog()
    {
        return "console.info('" . implode('', self::copyRightContent()) . "');";
    }

    /**
     * @return array
     */
    static function copyRightContent()
    {
        return [
            'This software belongs to: ',
            Config::CREATOR_NAME . ' ',
            '(' . Config::CREATOR_EMAIL . ')',
        ];
    }

    /**
     * @param string $content
     * @param string $title
     * @param array $cssFiles
     * @param array $jsFiles
     * @param string $mainJS
     * @return string
     */
    static function getHtml(
        $content = '',
        $title = '',
        $cssFiles = [],
        $jsFiles = [],
        $mainJS = ''
    ) {
        return
            self::DOCTYPE .
            self::copyRightComment() .
            self::htmlOpeningTag(getUserLanguage()) .
            self::HEAD_OPENING_TAG .
            self::metas() .
            self::title($title) .
            self::cssIncludes($cssFiles) .
            self::favicon(Config::FAVICON_URL()) .
            self::HEAD_CLOSING_TAG .
            self::BODY_OPENING_TAG .
            self::inlineJs() .
            $content . "\n" .
            self::BODY_CLOSING_TAG .
            self::jsIncludes($jsFiles) .
            self::mainJsInclude($mainJS) .
            self::HTML_CLOSING_TAG;
    }

    /**
     * @param string $page
     * @return string
     */
    static function getTitleByPageName($page = '')
    {
        if (!Config::APP_NAME || !strlen(Config::APP_NAME)) {
            return $page;
        }
        if (!!strlen($page)) {
            return Config::APP_NAME . ' | ' . $page;
        }
        return Config::APP_NAME;
    }

}
