 <?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'word' => 'weather',
        'description' => 'The weather is windy.'
    ],
    [
        'id' => 2,
        'word' => 'satellites',
        'description' => 'Satellites orbit the Earth.'
    ],
    [
        'id' => 3,
        'word' => 'temperature',
        'description' => 'The temperature is rising.'
    ],
     [
        'id' => 4,
        'word' => 'humidity',
        'description' => 'Humidity makes the air feel warmer.'
    ],
    [
        'id' => 5,
        'word' => 'atmosphere',
        'description' => 'The atmosphere is the layer of gases surrounding Earth.'
    ],
    [
        'id' => 6,
        'word' => 'precipitation',
        'description' => 'Precipitation includes rain, snow, and hail.'
    ],
     [
        'id' => 7,
        'word' => 'wind',
        'description' => 'The wind is blowing strongly.'
    ],
    [
        'id' => 8,
        'word' => 'climate',
        'description' => 'Climate refers to long-term weather patterns.'
    ],
    [
        'id' => 9,
        'word' => 'forecast',
        'description' => 'The forecast predicts rain tomorrow.'
    ],
    [
        'id' => 10,
        'word' => 'storm',
        'description' => 'A storm is approaching the city.'
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 7: Sentence Awareness', 'Read the sentence carefully.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="sentence-card h100p padding-10" id="wordCard">
                        <div class="sentence-card-text border-radius-35">
                            <div class="sentence-sentence" id="wordDescription">
                                <?php echo $data[0]['id']; ?>. <?php echo $data[0]['description']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-right" id="panelRight">
                    <img src="<?php echo BASE_PATH; ?>images/sentence-list.png" alt="Word List" class="sentence-list-logo">
                    <img src="<?php echo BASE_PATH; ?>images/collapse-btn.png" alt="Collapse" class="collapse-btn" id="collapseBtn">
                    <ul class="sentence-list">
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
    const wordDescription = document.getElementById('wordDescription');
    
    if (wordDescription && wordData[index]) {
        wordDescription.textContent = `${wordData[index].id}. ${wordData[index].description}`;
    }
}

function handleOptionClick(e) {
    const btn = e.currentTarget;
    const isCorrect = btn.getAttribute('data-flag') === 'true';
    const optionText = btn.querySelector('.option-text');
    optionText.style.background = isCorrect ? '#4CAF50' : '#F44336';
    optionText.style.color = 'white';
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const wordListItems = document.querySelectorAll('.sentence-list li');
    
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
