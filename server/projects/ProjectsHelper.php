<?php

namespace projects;

use base\config\Config;
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

        usort($githubProjects, function($a, $b) {
            if ($a['stargazers_count'] == $b['stargazers_count']) {
                if ($a['watchers_count'] == $b['watchers_count']) {
                    return $a['forks'] < $b['forks'];
                }
                return $a['watchers_count'] < $b['watchers_count'];
            }
            return $a['stargazers_count'] < $b['stargazers_count'];
        });

        $html = [];
        foreach ($githubProjects as $key => $repo) {
            $name = (isset($repo['name']) && !empty($repo['name']) ? $repo['name'] : '');
            $description = (isset($repo['description']) && !empty($repo['description']) ? $repo['description'] : '');
            $repoUrl = (isset($repo['html_url']) && !empty($repo['html_url']) ? $repo['html_url'] : '');
            $stars = (isset($repo['stargazers_count']) && !empty($repo['stargazers_count']) ? $repo['stargazers_count'] : 0);
            $watchers = (isset($repo['watchers_count']) && !empty($repo['watchers_count']) ? $repo['watchers_count'] : 0);
            $forks = (isset($repo['forks']) && !empty($repo['forks']) ? $repo['forks'] : 0);

            $repoHtml = [];
            $repoHtml[] = HtmlHelper::element('h3', ['class' => 'repo-name'], $name);
            $repoHtml[] = HtmlHelper::element('p', ['class' => 'repo-description'], $description);
            $repoHtml[] = HtmlHelper::element('div', ['class' => 'repo-stats'], implode('', [
                HtmlHelper::element('span', ['title' => 'Stars'], HtmlHelper::inlineImg(Config::MEDIA_ROOT_URL(). 'assets/star.svg') . $stars),
                HtmlHelper::element('span', ['title' => 'Watching'], HtmlHelper::inlineImg(Config::MEDIA_ROOT_URL() . 'assets/eye.svg') . $watchers),
                HtmlHelper::element('span', ['title' => 'Forks'], HtmlHelper::inlineImg(Config::MEDIA_ROOT_URL() . 'assets/fork.svg') . $forks),
            ]));

            $html[] = HtmlHelper::element(
                'li',
                [
                    'class' => 'repo',
                    'id' => 'repo-' . ($key + 1),
                ],
                HtmlHelper::textLink(
                    $repoUrl,
                    ['style' => 'display: block; text-decoration: none;'],
                    implode('', $repoHtml)
                )
            );
        }
        return HtmlHelper::element('ul', ['id' => 'projects-github-repos-list'], implode('', $html));
    }

}
