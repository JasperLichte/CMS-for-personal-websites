<?php

use helpers\RequestHelper;
use routing\Router;
use templates\TemplatesHelper;

require_once 'server/base/base.php';
require_once 'server/routing/Router.php';

RequestHelper::saveRequest();

echo TemplatesHelper::getHtml(Router::getComponentByRequest());
