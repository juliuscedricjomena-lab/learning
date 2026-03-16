<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'english' => 'Laugh',
        'korean' => '웃다'
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image2.png',
        'english' => 'Ride',
        'korean' => '탈것'
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 6: Final Say', 'Say the word one last time before finishing.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left expanded">
                    <div class="activity-record-layout">
                        <div class="activity-record-left">
                            <h1 class="opacity-50" style="color: white;"><?php echo $data[0]['english']; ?></h1>
                            <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage" class="activity-record-image">
                        </div>
                        <div class="activity-record-right">
                            <div class="activity-record-words">
                                <div class="activity-record-english" id="wordEnglish"><?php echo $data[0]['english']; ?></div>
                                <div class="activity-record-korean" id="wordKorean"><?php echo $data[0]['korean']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endActivityPanel(); ?>
        <?php startControls(); ?>
            <div class="controls-left">
                <img src="<?php echo BASE_PATH; ?>images/volume-control-btn.png" alt="Volume" class="volume-btn">
                <div class="speed-control">
                    <input type="range" min="1" max="100" value="50" class="speed-slider">
                    <div class="speed-labels">
                        <span>Slow</span>
                        <span>Fast</span>
                    </div>
                </div>
                <img src="<?php echo BASE_PATH; ?>images/play-btn.png" alt="Play" class="control-btn">
                <img src="<?php echo BASE_PATH; ?>images/refresh-btn.png" alt="Refresh" class="control-btn">
            </div>
            <div class="controls-right">
                <img src="<?php echo BASE_PATH; ?>images/indicator.png" alt="Indicator" class="indicator-img">
                <div class="items-control">
                    <div class="items-value" id="itemsValue">10</div>
                    <input type="range" min="1" max="20" value="10" class="items-slider" id="itemsSlider">
                    <div class="items-labels">
                        <span>1</span>
                        <span class="items-label-center">Items</span>
                        <span>20</span>
                    </div>
                </div>
            </div>
        <?php endControls(); ?>
    </div>
    <img src="<?php echo BASE_PATH; ?>images/next-btn.png" alt="Next" class="nav-btn">
</div>

<div id="toast" class="toast"></div>

<script>
const wordData = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function updateWord(index) {
    const wordImage = document.getElementById('wordImage');
    const wordKorean = document.getElementById('wordKorean');
    const wordEnglish = document.getElementById('wordEnglish');
    const wordHeader = document.querySelector('.activity-record-left .opacity-50');
    
    if (wordImage && wordKorean && wordEnglish && wordData[index]) {
        wordImage.src = wordData[index].image;
        wordKorean.textContent = wordData[index].korean;
        wordEnglish.textContent = wordData[index].english;
        if (wordHeader) wordHeader.textContent = wordData[index].english;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateWord(currentIndex);
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentIndex < wordData.length - 1) {
                currentIndex++;
                updateWord(currentIndex);
            }
        });
    }
});
</script>
