<?php

use api\helpers\ValueNames;


require_once __DIR__ . './../../base/base.php';
require_once __DIR__ . './../helpers/ValueNames.php';

$colorThemeId = (isset($_POST[ValueNames::COLOR_THEME_ID]) ? (int)$_POST[ValueNames::COLOR_THEME_ID] : 0);
$bgAnimation = (isset($_POST[ValueNames::BG_ANIMATION_BOOL]) ? (int)$_POST[ValueNames::BG_ANIMATION_BOOL] : 0);

if ($colorThemeId) {
    \database\QueryHelper::query(
        \database\Connection::getInstance(),
        'UPDATE settings SET value = ' . $colorThemeId . ' WHERE name = "DEFAULT_COLOR_THEME"'
    );
}
\database\QueryHelper::query(
    \database\Connection::getInstance(),
    'UPDATE settings SET value = ' . $bgAnimation . ' WHERE name = "BG_ANIMATION"'
);

header('Location: ' . \helpers\RequestHelper::getPreviousUrl());
exit();
