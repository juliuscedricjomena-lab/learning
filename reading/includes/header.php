<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="screen-orientation" content="landscape">
    <title>Kinder Reading Learning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/fredoka-one" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/sigmar-one" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/anonymous-pro" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/knewave" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>css/style.css">
    <style>#loader{display:flex;position:fixed;top:0;left:0;width:100%;height:100%;background:#fff;z-index:10000;justify-content:center;align-items:center;}</style>
</head>
<body>
    <div id="loader"><img src="<?php echo BASE_PATH; ?>images/logo.png" alt="Loading"></div>
    <div id="rotate-warning">
        <p>📱</p>
        <p>Please rotate your device to landscape</p>
    </div>
    <?php if ((isset($_GET['page']) ? $_GET['page'] : 'cover') !== 'cover' && (isset($_GET['page']) ? $_GET['page'] : 'cover') !== 'outline'): ?>
    <header>
        <div class="header-title">
            <img src="<?php echo BASE_PATH; ?>images/header-background.png" alt="Header" class="header-bg">
            <span class="header-text">Reading Learning</span>
        </div>
        <div class="tag-container">
            <img src="<?php echo BASE_PATH; ?>images/tag-background.png" alt="Tag" class="tag-bg">
            <span class="tag-text">Issue 52</span>
        </div>
        <?php if ((isset($_GET['page']) ? $_GET['page'] : 'cover') !== 'scoreboard'): ?>
        <div class="score-container">
            <div class="score-oval">
                <div class="score-left">
                    <img src="<?php echo BASE_PATH; ?>images/icons/correct-icon.png" alt="Correct">
                </div>
                <div class="score-right">0</div>
            </div>
            <div class="score-oval">
                <div class="score-left">
                    <img src="<?php echo BASE_PATH; ?>images/icons/incorrect-icon.png" alt="Incorrect">
                </div>
                <div class="score-right">0</div>
            </div>
        </div>
        <?php endif; ?>
        <div class="top-actions">
            <div class="action-btn action-btn-radius action-btn-folder">
                <img src="<?php echo BASE_PATH; ?>images/icons/folder.png" alt="Folder">
            </div>
            <div class="action-btn action-btn-radius action-btn-gear">
                <img src="<?php echo BASE_PATH; ?>images/icons/gear.png" alt="Settings">
            </div>
        </div>
    </header>
    <?php endif; ?>
    <main>
