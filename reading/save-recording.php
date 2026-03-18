<?php
$userId = 'user123';
$userDir = __DIR__ . '/recordings/' . $userId . '/';

if (!file_exists($userDir)) {
    mkdir($userDir, 0755, true);
}

if (isset($_FILES['audio']) && isset($_POST['word'])) {
    $word = $_POST['word'];
    $activity = isset($_POST['activity']) ? $_POST['activity'] : '';
    $prefix = $activity ? $activity . '_' . $word : $word;
    $pattern = $userDir . $prefix . '_*.webm';
    $existingFiles = glob($pattern);
    
    if (count($existingFiles) >= 3) {
        echo json_encode(['success' => false, 'error' => 'Maximum 3 recordings per word reached']);
        exit;
    }
    
    $nextNumber = count($existingFiles) + 1;
    
    $fileName = $prefix . '_' . $nextNumber . '.webm';
    $targetPath = $userDir . $fileName;
    
    if (move_uploaded_file($_FILES['audio']['tmp_name'], $targetPath)) {
        echo json_encode(['success' => true, 'file' => $fileName]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save file']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No audio file or word received']);
}
