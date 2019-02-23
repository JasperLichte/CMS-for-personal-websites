<?php

namespace projects;

class ProjectsHelper {

  const GITHUB_ENDPOINT = 'https://api.lichte.info/repos/github/';

  /**
   * @return array
   */
  private static function getGithubProjects() {
    $ch = curl_init(self::GITHUB_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($data, true);
    $obj = (array)$obj;
    if ($obj['success'] === true && is_array($obj['repos'])) {
      return $obj['repos'];
    }

    return [];
  }

  /**
   * @return array
   */
  public static function getProjects() {
    return [
      'github' => self::getGithubProjects(),
    ];
  }

}
