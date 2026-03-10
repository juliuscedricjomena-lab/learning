<?php
function startActivityPanel($title, $subtitle) {
    echo "
    <div class='activity-panel'>
        <div class='panel-header'>
            <div class='panel-title'>{$title}</div>
            <div class='panel-subtitle'>{$subtitle}</div>
        </div>
        <div class='panel-body'>
    ";
}

function endActivityPanel() {
    echo "
        </div>
    </div>
    ";
}
