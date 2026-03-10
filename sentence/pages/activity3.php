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
                        <div class="reading-display" id="sentenceDisplay"><?php echo $data[0]['sentences'][0]['subject'] . ' | ' . $data[0]['sentences'][0]['predicate'] . ' | ' . $data[0]['sentences'][0]['modifier']; ?></div>
                        <textarea id="userInput" class="typing-input" placeholder="Type the sentence here..."></textarea>
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

function updateSentence() {
    const activityImage = document.getElementById('activityImage');
    const sentenceDisplay = document.getElementById('sentenceDisplay');
    const userInput = document.getElementById('userInput');
    
    if (wordData[currentIndex] && wordData[currentIndex].sentences[currentSentenceIndex]) {
        activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[currentIndex].image;
        
        const sentence = wordData[currentIndex].sentences[currentSentenceIndex];
        const displaySentence = sentence.subject + ' | ' + sentence.predicate + ' | ' + sentence.modifier;
        sentenceDisplay.textContent = displaySentence;
        
        userInput.value = '';
    }
}

function checkTyping() {
    const userInput = document.getElementById('userInput');
    const sentenceDisplay = document.getElementById('sentenceDisplay');
    const sentence = wordData[currentIndex].sentences[currentSentenceIndex];
    const actualSentence = sentence.subject + ' ' + sentence.predicate + ' ' + sentence.modifier;
    const userText = userInput.value;
    
    let html = '';
    html += '<span class="reading-part">';
    
    for (let i = 0; i < actualSentence.length; i++) {
        const char = actualSentence[i];
        
        if (i < userText.length) {
            if (userText[i] === char) {
                html += '<span style="color: green;">' + char + '</span>';
            } else {
                html += '<span style="color: red;">' + char + '</span>';
            }
        } else {
            html += '<span style="color: black;">' + char + '</span>';
        }
    }
    
    html += '</span>';
    
    const parts = actualSentence.split(' ');
    const subjectEnd = sentence.subject.length;
    const predicateEnd = subjectEnd + 1 + sentence.predicate.length;
    
    let finalHtml = '';
    for (let i = 0; i < actualSentence.length; i++) {
        if (i === subjectEnd || i === predicateEnd) {
            finalHtml += ' <span style="color: #999;">|</span> ';
            i++;
        }
        
        const char = actualSentence[i];
        if (i < userText.length) {
            if (userText[i] === char) {
                finalHtml += '<span style="color: green;">' + char + '</span>';
            } else {
                finalHtml += '<span style="color: red;">' + char + '</span>';
            }
        } else {
            finalHtml += '<span style="color: black;">' + char + '</span>';
        }
    }
    
    sentenceDisplay.innerHTML = finalHtml;
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const userInput = document.getElementById('userInput');
    
    userInput.addEventListener('input', checkTyping);
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
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
