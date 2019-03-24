<?php

namespace templates\components;

require_once __DIR__ . './../../../projects/ProjectsHelper.php';

use projects\ProjectsHelper;

class HomeSectionsContentHelper
{

    /**
     * @return array
     */
    public static function getSections() {
        return [
            'hello' => [
                'header' => 'Hi',
                'content' => "<h1>huhu</h1>"
            ],
            'github-repos' => [
                'header' => 'My Repos on Github',
                'content' => ProjectsHelper::buildGithubProjectsHtml()
            ],
        ];
    }

}