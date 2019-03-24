<?php

namespace templates\components\home;

require_once __DIR__ . './../../HtmlHelper.php';
require_once 'HomeSectionsContentHelper.php';

use base\config\Config;
use templates\components\HomeSectionsContentHelper;
use templates\HtmlHelper;

class Home
{

    /**
     * @return string
     */
    private static function buildHeader()
    {
        return HtmlHelper::element(
            'header',
            [],
            HtmlHelper::element(
                'div',
                ['id' => 'header-wrapper'],
                'header'
            )
        );
    }

    /**
     * @return string
     */
    private static function buildMain()
    {
        $sectionsHtml = [];
        foreach (HomeSectionsContentHelper::getSections() as $key => $section) {
            $header = (isset($section['header']) && !empty($section['header'])
                ? HtmlHelper::element('h2', ['class' => 'section-header'], $section['header'])
                : '');
            $content = (isset($section['content']) && !empty($section['content'])
                ? $section['content']
                : '');

            $sectionsHtml[] = HtmlHelper::element(
                'section',
                [
                    'class'             => 'content-section',
                    'id'                => 'content-section-' . $key,
                    'data-section-name' => $key,
                ],
                $header . $content
            );
        }

        return HtmlHelper::element(
            'main',
            [],
            HtmlHelper::element(
                'div',
                ['id' => 'main-wrapper'],
                implode('', $sectionsHtml)
            )
        );
    }

    /**
     * @return string
     */
    private static function buildFooter()
    {
        $links = [
            HtmlHelper::textLink('mailto:' . Config::CREATOR_EMAIL, ['id' => 'creator-email'], 'Send me an eMail!'),
            HtmlHelper::textLink(Config::REPO_URL, ['id' => 'repo_url'], 'View the code'),
        ];
        $footerContent = [
            HtmlHelper::element('span', ['id' => 'creator-name'], Config::CREATOR_NAME),
            HtmlHelper::element('div', ['id' => 'links'], implode('', $links)),
        ];
        return HtmlHelper::element(
            'footer',
            [],
            HtmlHelper::element(
                'div',
                ['id' => 'footer-wrapper'],
                implode('', $footerContent)
            )
        );
    }

    /**
     * @return string
     */
    public static function build()
    {
        return
            (HtmlHelper::element(
                    'div',
                    ['id' => 'page'],
                    (self::buildHeader()
                        . self::buildMain()
                        . self::buildFooter())
                ) .
                HtmlHelper::element(
                    'canvas',
                    ['id' => 'bg-canvas']
                ));
    }

}
