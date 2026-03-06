 <?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/weather-2.png',
        'english' => 'weather',
        'options' => [
            [
                'id' => 2,
                'text' => 'wheather',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'weather',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'wether',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/satellite.png',
        'english' => 'satellites',
        'options' => [
            [
                'id' => 3,
                'text' => 'satelittes',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'satellites',
                'flag' => true
            ],
            [
                'id' => 2,
                'text' => 'satelites',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/weather.png',
        'english' => 'temperature',
        'options' => [
            [
                'id' => 2,
                'text' => 'tempereture',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => 'temperatur',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'temperature',
                'flag' => true
            ]
        ]
    ],
     [
        'id' => 4,
        'image' => 'images/gallery/humidity.png',
        'english' => 'climate',
        'options' => [
            [
                'id' => 3,
                'text' => 'climete',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'climete',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'climate',
                'flag' => true
            ]
        ]
    ],
    [
        'id' => 5,
        'image' => 'images/gallery/weather.png',
        'english' => 'atmosphere',
        'options' => [
            [
                'id' => 2,
                'text' => 'atmosfear',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'atmosphere',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'atmospher',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 6,
        'image' => 'images/gallery/humidity.png',
        'english' => 'precipitation',
        'options' => [
            [
                'id' => 3,
                'text' => 'precipitashun',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'precipitaton',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'precipitation',
                'flag' => true
            ]
        ]
    ],
     [
        'id' => 7,
        'image' => 'images/gallery/weather.png',
        'english' => 'wind',
        'options' => [
            [
                'id' => 2,
                'text' => 'wınd',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => 'wınd',
                'flag' => false
            ],
            [
                'id' => 1,
                'text' => 'wind',
                'flag' => true
            ]
        ]
    ],
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 3: Shape Memory', 'Look and choose the correct word.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="word-card" id="wordCard">
                        <div class="word-card-image">
                            <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage">
                        </div>
                        <div class="word-card-text">
                            <div class="base-word" id="baseWord"><?php echo $data[0]['english']; ?></div>
                            <button class="toggle-button" id="toggleBtn">
                                <img src="<?php echo BASE_PATH; ?>images/icons/eye-icon.png" alt="Eye" class="toggle-icon">
                                <span class="toggle-text">Hide</span>
                            </button>
                        </div>
                    </div>
                    <div class="options-container" id="optionsContainer" style="display: none;">
                        <?php foreach($data[0]['options'] as $option): ?>
                        <button class="option-btn" data-flag="<?php echo $option['flag'] ? 'true' : 'false'; ?>">
                            <div class="option-text"><?php echo $option['text']; ?></div>
                        </button>
                        <?php endforeach; ?>
                    </div>
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
    const baseWord = document.getElementById('baseWord');
    const optionsContainer = document.getElementById('optionsContainer');
    
    if (wordImage && baseWord && wordData[index]) {
        wordImage.src = wordData[index].image;
        baseWord.textContent = wordData[index].english;
        
        optionsContainer.innerHTML = '';
        wordData[index].options.forEach(option => {
            const btn = document.createElement('button');
            btn.className = 'option-btn';
            btn.setAttribute('data-flag', option.flag ? 'true' : 'false');
            btn.innerHTML = `<div class="option-text">${option.text}</div>`;
            btn.addEventListener('click', handleOptionClick);
            optionsContainer.appendChild(btn);
        });
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
    const wordListItems = document.querySelectorAll('.word-list li');
    const toggleBtn = document.getElementById('toggleBtn');
    const toggleText = toggleBtn.querySelector('.toggle-text');
    const baseWord = document.getElementById('baseWord');
    const optionsContainer = document.getElementById('optionsContainer');
    
    toggleBtn.addEventListener('click', function() {
        if (toggleText.textContent === 'Hide') {
            baseWord.style.display = 'none';
            optionsContainer.style.display = 'flex';
            toggleText.textContent = 'Show';
            const collapseBtn = document.getElementById('collapseBtn');
            if (collapseBtn) collapseBtn.click();
        } else {
            baseWord.style.display = 'block';
            optionsContainer.style.display = 'none';
            toggleText.textContent = 'Hide';
            const expandBtn = document.getElementById('expandBtn');
            if (expandBtn) expandBtn.click();
        }
    });
    
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
    
    document.querySelectorAll('.option-btn').forEach(btn => {
        btn.addEventListener('click', handleOptionClick);
    });
    
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
                baseWord.style.display = 'block';
                optionsContainer.style.display = 'none';
                toggleText.textContent = 'Hide';
                const expandBtn = document.getElementById('expandBtn');
                if (expandBtn && document.getElementById('panelCollapsed').style.display !== 'none') expandBtn.click();
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentIndex < wordData.length - 1) {
                currentIndex++;
                updateWord(currentIndex);
                setActiveWord(currentIndex);
                baseWord.style.display = 'block';
                optionsContainer.style.display = 'none';
                toggleText.textContent = 'Hide';
                const expandBtn = document.getElementById('expandBtn');
                if (expandBtn && document.getElementById('panelCollapsed').style.display !== 'none') expandBtn.click();
            }
        });
    }
});
</script>
