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
        <?php startActivityPanel('Activity 2: Phrase Awareness', 'Read the sentence in parts and identify each phrase’s role.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-flex">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image">
                    </div>
                    <div class="listening-description" id="sentenceDescription">
                        <?php 
                        foreach($data[0]['sentences'] as $num => $sentence) {
                            echo '<div class="listening-item">';
                            echo ($num + 1) . '. ';
                            echo '<span class="listening-subject">' . $sentence['subject'] . '</span>';
                            echo ' <span class="listening-separator">|</span> ';
                            echo '<span class="listening-predicate">' . $sentence['predicate'] . '</span>';
                            echo ' <span class="listening-separator">|</span> ';
                            echo '<span class="listening-modifier">' . $sentence['modifier'] . '</span>';
                            echo '</div>';
                        }
                        ?>
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

function updateWord(index) {
    const activityImage = document.querySelector('.activity-image-container img');
    const sentenceDescription = document.getElementById('sentenceDescription');
    
    if (activityImage && sentenceDescription && wordData[index]) {
        activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[index].image;
        
        let sentencesHTML = '';
        for (let num in wordData[index].sentences) {
            const sentence = wordData[index].sentences[num];
            sentencesHTML += '<div class="listening-item">';
            sentencesHTML += (parseInt(num) + 1) + '. ';
            sentencesHTML += '<span class="listening-subject">' + sentence.subject + '</span>';
            sentencesHTML += ' <span class="listening-separator">|</span> ';
            sentencesHTML += '<span class="listening-predicate">' + sentence.predicate + '</span>';
            sentencesHTML += ' <span class="listening-separator">|</span> ';
            sentencesHTML += '<span class="listening-modifier">' + sentence.modifier + '</span>';
            sentencesHTML += '</div>';
        }
        sentenceDescription.innerHTML = sentencesHTML;
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
