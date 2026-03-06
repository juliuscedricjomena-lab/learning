<?php
$userId = 'user123';
$userDir = __DIR__ . '/recordings/' . $userId . '/';
$word = isset($_GET['word']) ? $_GET['word'] : '';

$recordings = [];
if (file_exists($userDir)) {
    if ($word) {
        $files = glob($userDir . $word . '_*.webm');
    } else {
        $files = glob($userDir . '*.webm');
    }
    foreach ($files as $file) {
        $recordings[] = basename($file);
    }
}

header('Content-Type: application/json');
echo json_encode($recordings);
