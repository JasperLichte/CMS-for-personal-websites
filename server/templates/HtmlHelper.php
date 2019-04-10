<?php

namespace templates;


class HtmlHelper
{


    const DEFAULT_JS_TYPE = 'text/javascript';

    /**
     * @param string $tagName
     * @param array $attribs
     * @param string $content
     * @param bool $escapeContent
     * @return string
     */
    public static function element(
        $tagName = 'div',
        $attribs = [],
        $content = '',
        $escapeContent = false
    ) {
        $attribsHtml = '';
        foreach ($attribs as $key => $val) {
            if (!is_string($key) || !is_string($val)) {
                continue;
            }
            $attribsHtml .= " {$key}=\"{$val}\"";
        }

        if ($escapeContent) {
            $content = self::escape($content);
        }

        return
            "<{$tagName}{$attribsHtml}>"
            . $content .
            "</{$tagName}>";
    }

    /**
     * @param string $url
     * @param array $attribs
     * @param string $content
     * @param bool $escapeContent
     * @return string
     */
    public static function textLink($url = '', $attribs = [], $content = '', $escapeContent = false)
    {
        return self::element(
            'a',
            array_merge($attribs, ['href' => $url]),
            $content,
            $escapeContent
        );
    }

    /**
     * @param string $js
     * @param string $type
     * @param array $attribs
    */
    public static function script($js = '')
    {
        return self::element(
            'script',
            ['type' => self::DEFAULT_JS_TYPE],
            $js
        );
    }

    /**
     * @param string $src
     * @param string $type
     */
    public static function jsImport($src, $type = self::DEFAULT_JS_TYPE)
    {
        return self::element(
            'script',
            [
                'src' => $src,
                'type' => $type,
            ]
        );
    }

    /**
     * @param string $url
     */
    public static function favicon($url)
    {
        return self::element('link', ['rel' => 'icon', 'href' => $url, 'type' => 'image/x-icon']);
    }

    /**
     * @param string $title
     */
    public static function title($title) {
        return self::element('title', [], $title);
    }

    /**
     * @param string $content
     * @return string
     */
    public static function container($content = '')
    {
        return self::element('div', [], $content);
    }

    /**
     * @param string $src
     * @param array $attribs
     * @return string
     */
    public static function inlineImg($src = '', $attribs = [])
    {
        return self::element(
            'img',
            array_merge(
                $attribs,
                [
                    'src'   => $src,
                    'style' => 'height: 1rem; display: inline;',
                ]
            )
        );
    }

    /**
     * @param string $str
     * @return string
     */
    public static function escape($str = '')
    {
        return htmlspecialchars($str);
    }

}