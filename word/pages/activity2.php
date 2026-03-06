<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/weather-2.png',
        'word' => 'weather',
        'pronunciation' => 'wĕᴛʜ′ər'
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/satellite.png',
        'word' => 'satellites',
        'pronunciation' => 'sat-el-lites'
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/weather.png',
        'word' => 'temperature',
        'pronunciation' => 'tĕmp′ər-ə-chər'
    ],
     [
        'id' => 4,
        'image' => 'images/gallery/humidity.png',
        'word' => 'climate',
        'pronunciation' => 'klī-mət'
    ],
    [
        'id' => 5,
        'image' => 'images/gallery/weather.png',
        'word' => 'atmosphere',
        'pronunciation' => 'ætˈmɒsfɪər'
    ],
    [
        'id' => 6,
        'image' => 'images/gallery/humidity.png',
        'word' => 'precipitation',
        'pronunciation' => 'prɪsɪˈpɪtəʃən'
    ],
     [
        'id' => 7,
        'image' => 'images/gallery/weather.png',
        'word' => 'wind',
        'pronunciation' => 'wɪnd'
    ],
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 2: Pronunciation & Chunk', 'Listen and repeat the word twice.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="word-card h100p" id="wordCard">
                        <div class="word-card-image">
                            <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage">
                        </div>
                        <div class="word-card-text">
                            <div class="word-pronounciation" id="wordPronunciation"><?php echo $data[0]['pronunciation']; ?></div>
                            <div class="word-english" id="wordEnglish"><?php echo $data[0]['word']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="panel-right" id="panelRight">
                    <img src="<?php echo BASE_PATH; ?>images/word-list.png" alt="Word List" class="word-list-logo">
                    <img src="<?php echo BASE_PATH; ?>images/collapse-btn.png" alt="Collapse" class="collapse-btn" id="collapseBtn">
                    <ul class="word-list">
                        <?php foreach($data as $index => $item): ?>
                        <li data-index="<?php echo $index; ?>"><?php echo $item['word']; ?></li>
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
    const wordPronunciation = document.getElementById('wordPronunciation');
    const wordEnglish = document.getElementById('wordEnglish');
    
    if (wordImage && wordPronunciation && wordEnglish && wordData[index]) {
        wordImage.src = wordData[index].image;
        wordPronunciation.textContent = wordData[index].pronunciation;
        wordEnglish.textContent = wordData[index].word;
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
