<?php


use helpers\RequestHelper;

require_once __DIR__ . './../../base/base.php';

RequestHelper::saveRequest();

echo json_encode($_REQUEST);
echo json_encode($_POST);
exit();

if (!isset($post['values'])) {
    echo json_encode(['success' => false]);
    exit();
}
