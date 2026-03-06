 <?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'word' => 'humidity',
        'sentence' => 'The _______ is high today.'
    ],
    [
        'id' => 2,
        'word' => 'satellites',
        'sentence' => '________ orbit the Earth.'
    ],
    [
        'id' => 3,
        'word' => 'temperature',
        'sentence' => 'The _______ is warm today.'
    ],
    [
        'id' => 4,
        'word' => 'climate',
        'sentence' => 'The _______ is changing due to global warming.'
    ],
    [
        'id' => 5,
        'word' => 'atmosphere',
        'sentence' => 'The _______ protects us from harmful solar radiation.'
    ],
    [
        'id' => 6,
        'word' => 'precipitation',
        'sentence' => '________ includes rain, snow, and hail.'
    ],
    [
        'id' => 7,
        'word' => 'wind',
        'sentence' => 'The _______ is blowing today.'
    ],
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 8: Sentence Anchor', 'Read the sentence. Fill in the word.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left expanded">
                    <div class="word-card h100p" id="wordCard">
                        <div class="word-card-text">
                            <div class="word-sentence" id="wordSentence"><?php echo $data[0]['sentence']; ?></div>
                            <div class="fill-blanks-word" id="fillBlanksWord"></div>
                        </div>
                    </div>
                </div>
                <div class="panel-right" id="panelRight" style="display: none;">
                    <img src="<?php echo BASE_PATH; ?>images/word-list.png" alt="Word List" class="word-list-logo">
                    <img src="<?php echo BASE_PATH; ?>images/collapse-btn.png" alt="Collapse" class="collapse-btn" id="collapseBtn">
                    <ul class="word-list">
                        <?php foreach($data as $index => $item): ?>
                        <li data-index="<?php echo $index; ?>"><?php echo $item['word']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="panel-collapsed" id="panelCollapsed" style="display: flex;">
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
const answers = {};

function createFillBlanks(word, index) {
    const container = document.getElementById('fillBlanksWord');
    container.innerHTML = '';
    
    for (let i = 0; i < word.length; i++) {
        if (i === 1 || i === word.length - 3) {
            const input = document.createElement('input');
            input.type = 'text';
            input.maxLength = 1;
            input.className = 'blank-input';
            input.dataset.correct = word[i].toLowerCase();
            input.dataset.position = i;
            input.addEventListener('input', handleBlankInput);
            
            if (answers[index] && answers[index][i]) {
                input.value = answers[index][i].value;
                input.style.background = answers[index][i].background;
                input.style.color = answers[index][i].color;
            }
            
            container.appendChild(input);
        } else {
            const span = document.createElement('span');
            span.textContent = word[i];
            span.className = 'letter-span';
            container.appendChild(span);
        }
    }
}

function handleBlankInput(e) {
    const input = e.target;
    const value = input.value.toLowerCase();
    const correct = input.dataset.correct;
    const position = input.dataset.position;
    
    if (!answers[currentIndex]) answers[currentIndex] = {};
    
    if (value) {
        if (value === correct) {
            input.style.background = '#4CAF50';
            input.style.color = 'white';
        } else {
            input.style.background = '#F44336';
            input.style.color = 'white';
        }
        answers[currentIndex][position] = {
            value: value,
            background: input.style.background,
            color: input.style.color
        };
    } else {
        input.style.background = 'white';
        input.style.color = '#333';
        delete answers[currentIndex][position];
    }
}

function updateWord(index) {
    const wordSentence = document.getElementById('wordSentence');
    
    if (wordSentence && wordData[index]) {
        wordSentence.textContent = wordData[index].sentence;
        createFillBlanks(wordData[index].word, index);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const wordListItems = document.querySelectorAll('.word-list li');
    
    createFillBlanks(wordData[0].word, 0);
    
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
