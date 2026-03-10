<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'sentences' => [
            [
                'subject' => 'A meteorologist',
                'predicate' => 'is a scientist',
                'modifier' => 'who studies the weather'
            ],
            [
                'subject' => 'Computers',
                'predicate' => 'are very important',
                'modifier' => 'for predicting the weather'
            ],
            [
                'subject' => 'Weather forecasts',
                'predicate' => 'help keep',
                'modifier' => 'people safe'
            ]
        ],
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image1.png',
        'sentences' => [
            [
                'subject' => 'The sun',
                'predicate' => 'rises',
                'modifier' => 'in the east'
            ],
            [
                'subject' => 'Birds',
                'predicate' => 'sing beautifully',
                'modifier' => 'in the morning'
            ],
            [
                'subject' => 'Children',
                'predicate' => 'play happily',
                'modifier' => 'in the park'
            ]
        ],
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 3: Phrase Practice', 'Copy each phrase correctly.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-flex">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image" id="activityImage">
                    </div>
                    <div class="reading-description">
                        <div class="reading-inputs">
                            <div class="input-group">
                                <label>1.</label>
                                <input type="text" id="input1" class="reading-input" placeholder="Type your answer here">
                            </div>
                            <div class="input-group">
                                <label>2.</label>
                                <input type="text" id="input2" class="reading-input" placeholder="Type your answer here">
                            </div>
                            <div class="input-group">
                                <label>3.</label>
                                <input type="text" id="input3" class="reading-input" placeholder="Type your answer here">
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

<script>
const wordData = <?php echo json_encode($data); ?>;
let currentIndex = 0;
let currentSentenceIndex = 0;
const userAnswers = {};

function updateSentence() {
    const activityImage = document.getElementById('activityImage');
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');
    
    if (wordData[currentIndex] && wordData[currentIndex].sentences[currentSentenceIndex]) {
        activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[currentIndex].image;
        
        const key = `${currentIndex}-${currentSentenceIndex}`;
        input1.value = userAnswers[key]?.input1 || '';
        input2.value = userAnswers[key]?.input2 || '';
        input3.value = userAnswers[key]?.input3 || '';
        
        checkInputs();
    }
}

function saveAnswers() {
    const key = `${currentIndex}-${currentSentenceIndex}`;
    userAnswers[key] = {
        input1: document.getElementById('input1').value,
        input2: document.getElementById('input2').value,
        input3: document.getElementById('input3').value
    };
}

function checkInputs() {
    const sentence = wordData[currentIndex].sentences[currentSentenceIndex];
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');
    
    input1.style.borderColor = input1.value === sentence.subject ? 'blue' : (input1.value === '' ? '#EC8F24' : 'red');
    input2.style.borderColor = input2.value === sentence.predicate ? 'blue' : (input2.value === '' ? '#EC8F24' : 'red');
    input3.style.borderColor = input3.value === sentence.modifier ? 'blue' : (input3.value === '' ? '#EC8F24' : 'red');
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');
    
    input1.addEventListener('input', checkInputs);
    input2.addEventListener('input', checkInputs);
    input3.addEventListener('input', checkInputs);
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            saveAnswers();
            if (currentSentenceIndex > 0) {
                currentSentenceIndex--;
            } else if (currentIndex > 0) {
                currentIndex--;
                currentSentenceIndex = wordData[currentIndex].sentences.length - 1;
            }
            updateSentence();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            saveAnswers();
            if (currentSentenceIndex < wordData[currentIndex].sentences.length - 1) {
                currentSentenceIndex++;
            } else if (currentIndex < wordData.length - 1) {
                currentIndex++;
                currentSentenceIndex = 0;
            }
            updateSentence();
        });
    }
});
</script>
