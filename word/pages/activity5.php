 <?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/weather-2.png',
        'word' => 'weather',
        'description' => '밖의 공기 상태—맑거나, 비가 오거나, 바람이 부는 것처럼',
        'options' => [
            [
                'id' => 1,
                'text' => 'temperature',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'weather',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'climate',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/satellite.png',
        'word' => 'satellites',
        'description' => '지구 주위를 돌며 통신과 관측을 돕는 물체',
        'options' => [
            [
                'id' => 1,
                'text' => 'atmosphere',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'satellites',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'precipitation',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/weather.png',
        'word' => 'temperature',
        'description' => '무언가가 얼마나 뜨겁거나 차가운지',
        'options' => [
            [
                'id' => 1,
                'text' => 'humidity',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'wind',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => 'temperature',
                'flag' => true
            ]
        ]
    ],
     [
        'id' => 4,
        'image' => 'images/gallery/humidity.png',
        'word' => 'humidity',
        'description' => '공기 중의 수분이나 습기의 양',
        'options' => [
            [
                'id' => 1,
                'text' => 'satellites',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'weather',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => 'humidity',
                'flag' => true
            ]
        ]
    ],
    [
        'id' => 5,
        'image' => 'images/gallery/weather.png',
        'word' => 'atmosphere',
        'description' => '지구를 둘러싼 기체 층',
        'options' => [
            [
                'id' => 1,
                'text' => 'climate',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'atmosphere',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'temperature',
                'flag' => false
            ]
        ]
    ],
    [
        'id' => 6,
        'image' => 'images/gallery/humidity.png',
        'word' => 'precipitation',
        'description' => '비, 눈, 우박으로 하늘에서 떨어지는 물',
        'options' => [
            [
                'id' => 1,
                'text' => 'wind',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'humidity',
                'flag' => false
            ],
            [
                'id' => 3,
                'text' => 'precipitation',
                'flag' => true
            ]
        ]
    ],
     [
        'id' => 7,
        'image' => 'images/gallery/weather.png',
        'word' => 'wind',
        'description' => '느낄 수 있는 움직이는 공기',
        'options' => [
            [
                'id' => 1,
                'text' => 'precipitation',
                'flag' => false
            ],
            [
                'id' => 2,
                'text' => 'wind',
                'flag' => true
            ],
            [
                'id' => 3,
                'text' => 'satellites',
                'flag' => false
            ]
        ]
    ],
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 5: Reverse Recall', 'Look at the meaning. Choose the English word.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="word-card" id="wordCard">
                        <div class="word-card-image">
                            <img src="<?php echo BASE_PATH . BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage">
                        </div>
                        <div class="word-card-text">
                            <div class="kor-description" id="baseWord"><?php echo $data[0]['description']; ?></div>
                        </div>
                    </div>
                    <div class="options-container" id="optionsContainer">
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
    const baseWord = document.getElementById('baseWord');
    const optionsContainer = document.getElementById('optionsContainer');
    
    if (wordImage && baseWord && wordData[index]) {
        wordImage.src = wordData[index].image;
        baseWord.textContent = wordData[index].description;
        
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
