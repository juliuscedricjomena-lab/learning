<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        [
            'id' => 1,
            'sentence' => ' A meteorologist...'
        ],
        [
            'id' => 2,
            'sentence' => 'Computers are...'
        ],
        [
            'id' => 3,
            'sentence' => ' Weather forecast...'
        ]
    ],
    [
        [
            'id' => 4,
            'sentence' => 'The sun rises...'
        ],
        [
            'id' => 5,
            'sentence' => 'Birds sing...'
        ],
        [
            'id' => 6,
            'sentence' => 'Children play...'
        ]
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 5: Guided Sentence Construction', 'Use the hints to build the sentence.'); ?>
            <div class="panel-content-wrapper">
                <div class="reading-list-container" id="sentenceContainer">
                    <?php foreach($data[0] as $index => $item): ?>
                        <div class="reading-item-row">
                            <div class="reading-korean"><?php echo ($index + 1) . '. ' . $item['sentence']; ?></div>
                            <input type="text" class="reading-input" placeholder="Type your answer here" data-index="<?php echo $index; ?>">
                        </div>
                    <?php endforeach; ?>
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
let currentPage = 0;

function updatePage() {
    const container = document.getElementById('sentenceContainer');
    const template = wordData[currentPage].map((item, index) => `
        <div class="reading-item-row">
            <div class="reading-korean">${index + 1}. ${item.sentence}</div>
            <input type="text" class="reading-input" placeholder="Type your answer here" data-index="${index}">
        </div>
    `).join('');
    
    container.innerHTML = template;
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentPage > 0) {
                currentPage--;
                updatePage();
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentPage < wordData.length - 1) {
                currentPage++;
                updatePage();
            }
        });
    }
});
</script>
