<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    ['word' => 'Which picture shows glowing fireflies?', 'options' => ['image3', 'image9', 'image10'], 'correct' => 'image3'],
    ['word' => 'Which picture shows glowing fireflies?', 'options' => ['image4', 'image5', 'image6'], 'correct' => 'image5']
];

const IMG_PATH = 'images/gallery/';
const IMG_EXT = '.png';
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 2: Picture Match', 'Read the question and choose the matching picture.'); ?>
            <div class="panel-content-wrapper panel-centered">
                <div class="activity-match-container">
                    <div class="activity-match-word" id="currentWord">Which picture shows glowing fireflies?</div>
                    <div class="activity-match-options" id="optionsContainer">
                        <?php 
                        foreach ($data[0]['options'] as $index => $option): 
                        ?>
                            <div class="activity-match-option-wrapper">
                                <img src="<?php echo BASE_PATH . IMG_PATH . strtolower($option) . IMG_EXT; ?>" alt="<?php echo $option; ?>" class="activity-match-option" data-option="<?php echo strtolower($option); ?>">
                            </div>
                        <?php endforeach; ?>
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
const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
const wordEl = document.getElementById('currentWord');
const optionsContainer = document.getElementById('optionsContainer');

const data = <?php echo json_encode($data); ?>;
const basePath = '<?php echo BASE_PATH . IMG_PATH; ?>';
const imgExt = '<?php echo IMG_EXT; ?>';
const basePathRoot = '<?php echo BASE_PATH; ?>';
const labels = ['a', 'b', 'c'];

let currentIndex = 0;

function loadActivity(index) {
    const item = data[index];
    wordEl.textContent = item.word;
    
    optionsContainer.innerHTML = '';
    item.options.forEach((option, idx) => {
        const wrapper = document.createElement('div');
        wrapper.className = 'activity-match-option-wrapper';
        
        const img = document.createElement('img');
        img.src = basePath + option.toLowerCase() + imgExt;
        img.alt = option;
        img.className = 'activity-match-option';
        img.dataset.option = option.toLowerCase();
        
        img.addEventListener('click', function() {
            if (wrapper.querySelector('.activity-match-result-icon')) return;
            
            const isCorrect = option.toLowerCase() === item.correct.toLowerCase();
            
            const resultIcon = document.createElement('img');
            resultIcon.className = 'activity-match-result-icon';
            resultIcon.src = basePathRoot + 'images/gallery/' + (isCorrect ? 'correct.png' : 'incorrect.png');
            
            wrapper.appendChild(resultIcon);
        });
        
        wrapper.appendChild(img);
        optionsContainer.appendChild(wrapper);
    });
}

prevBtn?.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        loadActivity(currentIndex);
    }
});

nextBtn?.addEventListener('click', () => {
    if (currentIndex < data.length - 1) {
        currentIndex++;
        loadActivity(currentIndex);
    }
});

loadActivity(currentIndex);
</script>