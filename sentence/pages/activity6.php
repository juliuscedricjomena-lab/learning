 <?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'word' => 'weather',
        'sound' => 'sounds/weather.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '달',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '날씨',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => '별',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 2,
        'word' => 'satellites',
        'sound' => 'sounds/satellites.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '구름',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '인공위성',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => '하늘',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 3,
        'word' => 'temperature',
        'sound' => 'sounds/temperature.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '바람',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '습도',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => '온도',
                'flag' => true
            ]
        ]
    ],
     [
        'id' => 4,
        'word' => 'humidity',
        'sound' => 'sounds/humidity.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '태양',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '기온',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => '습도',
                'flag' => true
            ]
        ]
    ],
    [
        'id' => 5,
        'word' => 'atmosphere',
        'sound' => 'sounds/atmosphere.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '날씨',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '대기',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => '온도',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 6,
        'word' => 'precipitation',
        'sound' => 'sounds/precipitation.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '구름',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '습도',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => '강수',
                'flag' => true
            ]
        ]
    ],
    [
        'id' => 7,
        'word' => 'wind',
        'sound' => 'sounds/wind.mp3',
        'options' => [
            [
                'id' => 1,
                'text' => '강수',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => '바람',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => '인공위성',
                'flag' => false
            ]
        ]
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 6: Sound Mapping', 'Listen and choose the korean meaning.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="sentence-card h70p padding-10" id="wordCard">
                        <div class="sentence-card-text border-radius-35">
                            <div class="header-word" id="baseWord"><?php echo $data[0]['word']; ?></div>
                            <button class="play-sentence-btn" id="playWordBtn">
                                <img src="<?php echo BASE_PATH; ?>images/icons/eye-icon.png" alt="Eye" class="play-sentence-icon">
                                <span>Play</span>
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
    const baseWord = document.getElementById('baseWord');
    const optionsContainer = document.getElementById('optionsContainer');
    
    if (baseWord && wordData[index]) {
        baseWord.textContent = wordData[index].word;
        optionsContainer.style.display = 'none';
        
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
    const wordListItems = document.querySelectorAll('.sentence-list li');
    const playWordBtn = document.getElementById('playWordBtn');
    const optionsContainer = document.getElementById('optionsContainer');
    
    if (playWordBtn) {
        playWordBtn.addEventListener('click', function() {
            const btnText = playWordBtn.querySelector('span');
            btnText.textContent = 'Playing...';
            playWordBtn.disabled = true;
            
            const audio = new Audio(wordData[currentIndex].sound);
            audio.play();
            audio.onended = function() {
                optionsContainer.style.display = 'flex';
                btnText.textContent = 'Play';
                playWordBtn.disabled = false;
            };
        });
    }
    
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
