<?php

namespace templates\components;

require_once __DIR__ . './../HtmlHelper.php';
require_once __DIR__ . './HomeSectionsContentHelper.php';

use templates\HtmlHelper;

class Home
{

    /**
     * @return string
     */
    private static function buildHeader() {
        return HtmlHelper::element(
            'header',
            [],
            'header'
        );
    }

    /**
     * @return string
     */
    private static function buildMain() {
        $sectionsHtml = [];
        foreach (HomeSectionsContentHelper::getSections() as $key => $section) {
            $sectionsHtml[] = HtmlHelper::element(
                'section',
                ['id' => 'content-section-' . $key],
                $section
            );
        }

        return HtmlHelper::element(
            'main',
            [],
            HtmlHelper::element(
                'div',
                ['id' => 'content',],
                implode('', $sectionsHtml)
            )
        );
    }

    /**
     * @return string
     */
    private static function buildFooter() {
        $links = [
            HtmlHelper::textLink('mailto:' . CREATOR_EMAIL, ['id' => 'creator-email'], 'Send me an eMail!'),
            HtmlHelper::textLink(REPO_URL, ['id' => 'repo_url'], 'View the code'),
        ];
        $footerContent = [
            HtmlHelper::element('span', ['id' => 'creator-name'], CREATOR_NAME),
            HtmlHelper::element('div', ['id' => 'links'], implode('', $links))
        ];
        return HtmlHelper::element(
            'footer',
            [],
            implode('', $footerContent)
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
