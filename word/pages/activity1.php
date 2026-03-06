<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/weather.png',
        'english' => 'weather',
        'korean' => '날씨',
        'description' => 'Weather means what the air is like outside—like sunny, rainy, or windy.'
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/humidity.png',
        'english' => 'humidity',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/weather.png',
        'english' => 'temperature',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
     [
        'id' => 4,
        'image' => 'images/gallery/humidity.png',
        'english' => 'climate',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
    [
        'id' => 5,
        'image' => 'images/gallery/weather.png',
        'english' => 'atmosphere',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
    [
        'id' => 6,
        'image' => 'images/gallery/humidity.png',
        'english' => 'precipitation',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
     [
        'id' => 7,
        'image' => 'images/gallery/weather.png',
        'english' => 'wind',
        'korean' => '습도',
        'description' => 'Humidity is the amount of water or moisture in the air.'
    ],
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1: Meaning Hook', 'Read once. Say it in Korean.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="word-card" id="wordCard">
                        <div class="word-card-image">
                            <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage">
                        </div>
                        <div class="word-card-text">
                            <div class="word-korean" id="wordKorean"><?php echo $data[0]['korean']; ?></div>
                            <div class="word-english" id="wordEnglish"><?php echo $data[0]['english']; ?></div>
                        </div>
                    </div>
                    <div class="word-description" id="wordDescription"><?php echo $data[0]['description']; ?></div>
                </div>
                <div class="panel-right" id="panelRight">
                    <img src="<?php echo BASE_PATH; ?>images/word-list.png" alt="Word List" class="word-list-logo">
                    <img src="<?php echo BASE_PATH; ?>images/collapse-btn.png" alt="Collapse" class="collapse-btn" id="collapseBtn">
                    <ul class="word-list">
                        <?php foreach($data as $index => $item): ?>
                        <li data-index="<?php echo $index; ?>"><?php echo $item['english']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="panel-collapsed" id="panelCollapsed" style="display: none;">
                    <img src="<?php echo BASE_PATH; ?>images/expand-btn.png" alt="Expand" class="expand-btn" id="expandBtn">
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

<script>
const wordData = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function updateWord(index) {
    const wordImage = document.getElementById('wordImage');
    const wordKorean = document.getElementById('wordKorean');
    const wordEnglish = document.getElementById('wordEnglish');
    const wordDescription = document.getElementById('wordDescription');
    
    if (wordImage && wordKorean && wordEnglish && wordDescription && wordData[index]) {
        wordImage.src = wordData[index].image;
        wordKorean.textContent = wordData[index].korean;
        wordEnglish.textContent = wordData[index].english;
        wordDescription.textContent = wordData[index].description;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const wordListItems = document.querySelectorAll('.word-list li');
    
    function setActiveWord(index) {
        wordListItems.forEach((item, i) => {
            if (i === index) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    }
    
    setActiveWord(0);
    
    wordListItems.forEach(item => {
        item.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            currentIndex = index;
            updateWord(currentIndex);
            setActiveWord(currentIndex);
        });
    });
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateWord(currentIndex);
                setActiveWord(currentIndex);
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentIndex < wordData.length - 1) {
                currentIndex++;
                updateWord(currentIndex);
                setActiveWord(currentIndex);
            }
        });
    }
});
</script>
