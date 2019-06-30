<?php

namespace bg_animations;

use base\config\Config;
use database\Connection;
use database\QueryHelper;
use helpers\RequestHelper;
use templates\HtmlHelper;

require_once __DIR__ . './../base/base.php';

class BgAnimationsHelper
{

    /**
     * @param int $limit
     * @return array
     */
    public static function getAnimations($limit = null)
    {
        return QueryHelper::getTableFields(
            Connection::getInstance(),
            'bg_animations',
            ['id', 'name'],
            'animation_index >= 0',
            'animation_index, name',
            $limit
        ) ?: [];
    }

    /**
     * @return int
     */
    public static function getAnimationForIp()
    {
        $ip = RequestHelper::getRequestIP();
        $animationId = (int)QueryHelper::getTableFieldElement(
            Connection::getInstance(),
            'bg_animations_ip',
            'bgAnimationId',
            'ip = "' . $ip . '"'
        );
        return ($animationId ? $animationId : Config::get('DEFAULT_BG_ANIMATION'));
    }

    /**
     * @return string
     */
    public static function buildAnimationsSectionHtml()
    {
        $html = [];
        foreach (self::getAnimations(10) as $animation) {
            $html[] = HtmlHelper::element(
                'button',
                [
                    'class' => 'bg-animation-button',
                    'data-animation-id' => (int)$animation['id']
                ],
                $animation['name']
            );
        }
        $html[] = HtmlHelper::element(
            'button',
            [
                'class' => 'bg-animation-button',
                'id' => 'None',
                'data-animation-id' => -1,
            ],
            'None'
        );
        $html[] = HtmlHelper::element(
            'button',
            [
                'class' => 'bg-animation-button',
                'id' => 'reset',
                'data-animation-id' => 0,
            ],
            'Reset to default'
        );
        return implode('', $html);
    }

}
