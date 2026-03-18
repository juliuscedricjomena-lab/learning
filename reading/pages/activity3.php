<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'question' => 'Fireflies glow at day.',
        'correct' => false,
    ],
    [
        'id' => 2,
        'question' => 'Fireflies use their glow to talk and find friends.',
        'correct' => true
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 3: True or False', 'Read the sentence and say if it is true or false.'); ?>
            <div class="panel-content-wrapper panel-centered">
                <div class="tf-container">
                    <div class="tf-question" id="tfQuestion"><?php echo $data[0]['question']; ?></div>
                    <div class="tf-buttons">
                        <div class="tf-btn-wrapper">
                            <button class="tf-btn tf-true" id="btnTrue">True</button>
                        </div>
                        <div class="tf-btn-wrapper">
                            <button class="tf-btn tf-false" id="btnFalse">False</button>
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
const BASE_PATH = '<?php echo BASE_PATH; ?>';
const tfData = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function updateQuestion() {
    document.getElementById('tfQuestion').textContent = tfData[currentIndex].question;
    document.getElementById('btnTrue').classList.remove('tf-correct', 'tf-wrong');
    document.getElementById('btnFalse').classList.remove('tf-correct', 'tf-wrong');
    document.querySelectorAll('.tf-result-icon').forEach(el => el.remove());
}

function checkAnswer(answer) {
    const isCorrect = tfData[currentIndex].correct === answer;
    const btnTrue = document.getElementById('btnTrue');
    const btnFalse = document.getElementById('btnFalse');
    
    btnTrue.classList.remove('tf-correct', 'tf-wrong');
    btnFalse.classList.remove('tf-correct', 'tf-wrong');
    document.querySelectorAll('.tf-result-icon').forEach(el => el.remove());
    
    const clickedBtn = answer ? btnTrue : btnFalse;
    clickedBtn.classList.add(isCorrect ? 'tf-correct' : 'tf-wrong');
    
    const icon = document.createElement('img');
    icon.className = 'tf-result-icon';
    icon.src = BASE_PATH + 'images/gallery/' + (isCorrect ? 'correct.png' : 'incorrect.png');
    clickedBtn.parentElement.appendChild(icon);
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('btnTrue').addEventListener('click', () => checkAnswer(true));
    document.getElementById('btnFalse').addEventListener('click', () => checkAnswer(false));
    
    document.querySelector('.nav-btn[alt="Previous"]')?.addEventListener('click', () => {
        if (currentIndex > 0) { currentIndex--; updateQuestion(); }
    });
    
    document.querySelector('.nav-btn[alt="Next"]')?.addEventListener('click', () => {
        if (currentIndex < tfData.length - 1) { currentIndex++; updateQuestion(); }
    });
});
</script>
