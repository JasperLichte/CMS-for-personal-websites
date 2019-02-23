<?php

use templates\HtmlHelper;
use templates\TemplatesHelper;
use projects\ProjectsHelper;

require_once "server/templates/TemplatesHelper.php";
require_once "server/templates/HtmlHelper.php";
require_once "server/projects/ProjectsHelper.php";

echo
TemplatesHelper::getHtml(
  HtmlHelper::element(
    'main',
    ['id' => 'main'],
    'in progress'
  ),
  TemplatesHelper::getTitleByPageName('Home'),
  ['bundle.css'],
  [],
  [
    'projects' => ProjectsHelper::getProjects(),
  ]
);
