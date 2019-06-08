<?php

use api\helpers\ValueNames;

require_once __DIR__ . './../../base/base.php';
require_once __DIR__ . './../../api/Helpers/ValueNames.php';

$colorThemeId = (isset($_POST[ValueNames::COLOR_THEME_ID]) ? (int)$_POST[ValueNames::COLOR_THEME_ID] : 0);

if ($colorThemeId) {
    \database\QueryHelper::query(
        \database\Connection::getInstance(),
        'UPDATE settings SET value = ' . $colorThemeId . ' WHERE name = "DEFAULT_COLOR_THEME"'
    );
}

header('Location: ' . \helpers\RequestHelper::getPreviousUrl());
exit();
