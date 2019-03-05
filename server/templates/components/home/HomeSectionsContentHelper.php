<?php

namespace templates\components;


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
            'projects' => [
                'header' => 'My Projects',
                'content' => ProjectsHelper::buildProjectsHtml()
            ],
        ];
    }

}