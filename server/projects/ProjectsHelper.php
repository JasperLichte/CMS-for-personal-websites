<?php

namespace projects;

use templates\HtmlHelper;

class ProjectsHelper
{

    const GITHUB_ENDPOINT = 'https://api.lichte.info/repos/github/';

    /**
     * @return array
     */
    private static function getGithubProjects()
    {
        $ch = curl_init(self::GITHUB_ENDPOINT);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($data, true);
        $obj = (array)$obj;
        if (isset($obj['success']) && $obj['success'] === true && is_array($obj['repos'])) {
            return $obj['repos'];
        }

        return [];
    }

    /**
     * @return array
     */
    public static function getProjects()
    {
        return [
            'github' => self::getGithubProjects(),
        ];
    }

    /**
     * @return string
     */
    public static function buildProjectsHtml()
    {
        $projects = self::getProjects();
        $githubProjects = (is_array($projects) && isset($projects['github']) ? $projects['github'] : []);

        $html = [];
        foreach ($githubProjects as $key => $repo) {
            $name = (isset($repo['name']) && !empty($repo['name']) ? $repo['name'] : '');
            $description = (isset($repo['description']) && !empty($repo['description']) ? $repo['description'] : '');

            $repoHtml = [];
            $repoHtml[] = HtmlHelper::element('h3', ['class' => 'repo-name'], $name);
            $repoHtml[] = HtmlHelper::element('p', ['class' => 'repo-name'], $description);

            $html[] = HtmlHelper::element(
                'li',
                [
                    'class' => 'repo',
                    'id' => 'repo-' . ($key + 1),
                ],
                implode('', $repoHtml)
            );
        }
        return HtmlHelper::element('ul', ['id' => 'projects-github-repos-list'], implode('', $html));
    }

}
