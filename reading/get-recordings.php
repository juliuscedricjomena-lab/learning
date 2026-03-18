<?php
$userId = 'user123';
$userDir = __DIR__ . '/recordings/' . $userId . '/';
$word = isset($_GET['word']) ? $_GET['word'] : '';
$activity = isset($_GET['activity']) ? $_GET['activity'] : '';

$recordings = [];
if (file_exists($userDir)) {
    $prefix = $activity ? $activity . '_' . $word : $word;
    if ($word) {
        $files = glob($userDir . $prefix . '_*.webm');
    } else {
        $files = glob($userDir . '*.webm');
    }
    foreach ($files as $file) {
        $recordings[] = basename($file);
    }
}

header('Content-Type: application/json');
echo json_encode($recordings);
