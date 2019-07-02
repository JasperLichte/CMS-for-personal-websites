<?php

use database\Connection;
use database\QueryHelper;
use color_themes\ColorThemesHelper;
use helpers\RequestHelper;

require_once __DIR__ . './../../base/base.php';
require_once __DIR__ . './../../color_themes/ColorThemesHelper.php';

RequestHelper::saveRequest();

$themeId = (int)(isset($_GET['themeId']) ? $_GET['themeId'] : 0);

if (!$themeId && $themeId != 0) {
    echo json_encode(['error' => 'No themeId given']);
    exit();
}

$ip = RequestHelper::getRequestIP();

$res = [];
if ($themeId == 0) {
    $success = QueryHelper::query(
        Connection::getInstance(),
        'DELETE FROM color_themes_ip WHERE ip = "' . $ip . '"'
    );

    if (!$success) {
        $res = ['error' => 500];
    } else {
        $res = [
            'success' => true,
            'data' => [
                'theme' => ColorThemesHelper::getDefaultThemeValues(),
            ],
        ];
    }
}
else {
    $success = QueryHelper::query(
        Connection::getInstance(),
        'INSERT INTO color_themes_ip (ip, colorThemeId) VALUES("' . $ip . '", ' . $themeId . ')
         ON DUPLICATE KEY UPDATE    
         ip="' . $ip . '", colorThemeId=' . $themeId
    );

    if (!$success) {
        $res = ['error' => 500];
    } else {
        $res = [
            'success' => true,
            'data'    => [
                'theme' => ColorThemesHelper::getThemeValuesById($themeId),
            ],
        ];
    }
}

echo json_encode($res);
