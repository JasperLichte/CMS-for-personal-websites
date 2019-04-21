<?php

namespace templates\components;

require_once __DIR__ . './../../../base/base.php';
require_once __DIR__ . './../../../projects/ProjectsHelper.php';

use database\Connection;
use database\QueryHelper;
use projects\ProjectsHelper;

class HomeSectionsContentHelper
{

    const HELLO = 'hello';
    const GITHUB_REPOS = 'github-repos';

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
        switch ($sectionName) {
            case self::HELLO:
                $header = 'Hi';
                $content = '<h1>huhu</h1>';
                break;
            case self::GITHUB_REPOS:
                $header = 'My Repos on Github';
                $content = ProjectsHelper::buildGithubProjectsHtml();
                break;
        }
        return ['header' => $header, 'content' => $content];
    }

}