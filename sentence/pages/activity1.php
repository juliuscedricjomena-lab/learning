<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'sentences' => [
            1 => 'A meteorologist is a scientist who studies the weather.',
            2 => 'Computers are very important for predicting the weather.',
            3 => 'Weather forecasts help keep people safe.',
        ],
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image1.png',
        'sentences' => [
            1 => 'Test sentence 1 for word 2.',
            2 => 'Test sentence 2 for word 2.',
            3 => 'Test sentence 3 for word 2.',
        ],
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1: Vocabulary Anchor', 'Read the sentence and match the key word to its meaning.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-flex">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image">
                    </div>
                    <div class="sentence-description" id="sentenceDescription">
                        <?php 
                        foreach($data[0]['sentences'] as $num => $sentence) {
                            echo $num . '. ' . $sentence . '<br><br>';
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
            sentencesHTML += num + '. ' + wordData[index].sentences[num] + '<br><br>';
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
