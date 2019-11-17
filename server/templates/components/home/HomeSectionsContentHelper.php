<?php

namespace templates\components;

require_once __DIR__ . './../../../base/base.php';
require_once __DIR__ . './../../../about_me/AboutMeHelper.php';
require_once __DIR__ . './../../../projects/ProjectsHelper.php';
require_once __DIR__ . './../../../color_themes/ColorThemesHelper.php';
require_once __DIR__ . './../../../bg_animations/BgAnimationsHelper.php';

use about_me\AboutMeHelper;
use bg_animations\BgAnimationsHelper;
use database\Connection;
use database\QueryHelper;
use color_themes\ColorThemesHelper;
use projects\ProjectsHelper;

class HomeSectionsContentHelper
{

    const HELLO = 'hello';
    const ABOUT_ME = 'about-me';
    const GITHUB_REPOS = 'github-repos';
    const LIVE_PROJECTS = 'live-projects';
    const COLOR_THEMES = 'color-themes';
    const BG_ANIMATIONS = 'bg-animations';

    /**
     * @return array
     */
    public static function getSections()
    {
        $_sections = QueryHelper::getTableFields(
            Connection::getInstance(),
            'home_sections',
            ['section_name', 'section_index'],
            'section_index >= 0',
            'section_index ASC'
        );

        $sections = [];
        foreach ($_sections as $section) {
            $sections[$section['section_name']] = self::getSectionByName($section['section_name']);
        }
        return $sections;
    }

    /**
     * @param string $sectionName
     * @return array
     */
    private static function getSectionByName($sectionName)
    {
        $header = '';
        $content = '';
        switch (strtolower((string)$sectionName)) {
            case self::HELLO:
                $header = 'Hi';
                $content = '<h1>huhu</h1>';
                break;
            case self::ABOUT_ME:
                $header = 'Who am I?';
                $content = AboutMeHelper::buildInfoSection();
                break;
            case self::GITHUB_REPOS:
                $header = 'My Repos on Github';
                $content = ProjectsHelper::buildGithubProjectsHtml();
                break;
            case self::LIVE_PROJECTS:
                $header = 'Demos of my work';
                $content = ProjectsHelper::buildLiveProjectsHtml();
                break;
            case self::COLOR_THEMES:
                $content = ColorThemesHelper::buildThemesSectionHtml();
                break;
            case self::BG_ANIMATIONS:
                $content = BgAnimationsHelper::buildAnimationsSectionHtml();
                break;
        }
        return ['header' => $header, 'content' => $content];
    }

}