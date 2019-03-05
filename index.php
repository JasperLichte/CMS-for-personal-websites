<?php

use templates\TemplatesHelper;
use projects\ProjectsHelper;
use templates\components\home\Home;

require_once "server/templates/TemplatesHelper.php";
require_once "server/projects/ProjectsHelper.php";
require_once "server/templates/components/home/Home.php";

echo
TemplatesHelper::getHtml(
  Home::build(),
  TemplatesHelper::getTitleByPageName('Home'),
  ['bundle.css'],
  [],
  [
    //'projects' => ProjectsHelper::getProjects(),
  ]
);
