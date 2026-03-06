<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        [
            'id' => 1,
            'sentence' => '기상학자는 날씨를 연구하는 과학자이다.'
        ],
        [
            'id' => 2,
            'sentence' => '컴퓨터는 날씨를 예측하는 데 매우 중요하다.'
        ],
        [
            'id' => 3,
            'sentence' => '날씨 예보는 사람들을 안전하게 지켜준다.'
        ]
    ],
    [
        [
            'id' => 4,
            'sentence' => '태양은 동쪽에서 뜬다.'
        ],
        [
            'id' => 5,
            'sentence' => '새들은 아침에 아름답게 노래한다.'
        ],
        [
            'id' => 6,
            'sentence' => '아이들은 공원에서 행복하게 논다.'
        ]
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 4: Phrase Recall Writing', 'Write the English phrase that matches the meaning.'); ?>
            <div class="panel-content-wrapper">
                <div class="sentence-list-container" id="sentenceContainer">
                    <?php foreach($data[0] as $index => $item): ?>
                        <div class="sentence-item-row">
                            <div class="sentence-korean"><?php echo ($index + 1) . '. ' . $item['sentence']; ?></div>
                            <input type="text" class="sentence-input" placeholder="Type your answer here" data-index="<?php echo $index; ?>">
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
        <div class="sentence-item-row">
            <div class="sentence-korean">${index + 1}. ${item.sentence}</div>
            <input type="text" class="sentence-input" placeholder="Type your answer here" data-index="${index}">
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
