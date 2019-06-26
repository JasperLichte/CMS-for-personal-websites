<?php

use database\Connection;
use database\QueryHelper;
use helpers\RequestHelper;

require_once __DIR__ . './../../base/base.php';

$themeId = (int)(isset($_GET['themeId']) ? $_GET['themeId'] : 0);

if (!$themeId) {
    echo json_encode(['error' => 'No themeId given']);
    exit();
}

$ip = RequestHelper::getRequestIP();
echo json_encode(['success' => $ip]);

QueryHelper::query(
  Connection::getInstance(),
  'INSERT INTO color_themes_ip (ip, colorThemeId) VALUES("' . $ip . '", ' . $themeId . ')
  ON DUPLICATE KEY UPDATE    
  ip="' . $ip . '", colorThemeId=' . $themeId
);
