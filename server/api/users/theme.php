<?php

use database\Connection;
use database\QueryHelper;
use helpers\ColorThemesHelper;
use helpers\RequestHelper;

require_once __DIR__ . './../../base/base.php';
require_once __DIR__ . './../../helpers/ColorThemesHelper.php';

$themeId = (int)(isset($_GET['themeId']) ? $_GET['themeId'] : 0);

if (!$themeId) {
    echo json_encode(['error' => 'No themeId given']);
    exit();
}

$ip = RequestHelper::getRequestIP();

$success = QueryHelper::query(
  Connection::getInstance(),
  'INSERT INTO color_themes_ip (ip, colorThemeId) VALUES("' . $ip . '", ' . $themeId . ')
  ON DUPLICATE KEY UPDATE    
  ip="' . $ip . '", colorThemeId=' . $themeId
);

if (!$success) {
    echo json_encode(['error' => 'No themeId given']);
    exit();
}

echo json_encode([
    'success' => $ip,
    'data' => [
        'theme' => ColorThemesHelper::getThemeValuesById($themeId),
    ],
]);
