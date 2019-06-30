<?php

use database\Connection;
use database\QueryHelper;
use helpers\RequestHelper;

require_once __DIR__ . './../../base/base.php';
require_once __DIR__ . './../../color_themes/ColorThemesHelper.php';

$animationId = (int)(isset($_GET['animationId']) ? $_GET['animationId'] : 0);

if (!$animationId && $animationId != 0) {
    echo json_encode(['error' => 'No themeId given']);
    exit();
}

$ip = RequestHelper::getRequestIP();

$res = [];
if ($animationId == 0) {
    $success = QueryHelper::query(
        Connection::getInstance(),
        'DELETE FROM bg_animations_ip WHERE ip = "' . $ip . '"'
    );

    if (!$success) {
        $res = ['error' => 500];
    } else {
        $res = ['success' => true,];
    }
}
else {
    $success = QueryHelper::query(
        Connection::getInstance(),
        'INSERT INTO bg_animations_ip (ip, bgAnimationId) VALUES("' . $ip . '", ' . $animationId . ')
         ON DUPLICATE KEY UPDATE    
         ip="' . $ip . '", bgAnimationId=' . $animationId
    );

    if (!$success) {
        $res = ['error' => 500];
    } else {
        $res = ['success' => true,];
    }
}

echo json_encode($res);

