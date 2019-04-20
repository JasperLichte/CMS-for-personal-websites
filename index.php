<?php

use helpers\RequestHelper;
use routing\Router;
use templates\TemplatesHelper;

require_once 'server/base/base.php';
require_once 'server/routing/Router.php';

RequestHelper::saveRequest();
$component = Router::getComponentByRequest();

echo
TemplatesHelper::getHtml(
    $component::build(),
    TemplatesHelper::getTitleByPageName($component::NAME),
    $component::NEEDED_CSS_FILES,
    $component::NEEDED_JS_FILES,
    $component::MAIN_JS_FILE()
);
