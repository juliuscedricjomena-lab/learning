<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'sentence' => 'Inside their tails, a special light is made. A chemical called luciferin helps them glow. When air mixes in, the light shines brightly.',
        'highlights' => [
            ['text' => 'A chemical called luciferin helps them glow.', 'color' => 'purple']
        ]
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image2.png',
        'sentence' => 'At night, tiny fireflies light up the sky. Their bodies shine softly in the dark night. They look like stars dancing in the air.',
        'highlights' => [
            ['text' => 'stars dancing in the air.', 'color' => 'purple']
        ]
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/image3.png',
        'sentence' => 'Fireflies use their glow to talk and find friends. Each one has its own flashing pattern. That is how they share messages in the night.',
        'highlights' => []
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1:  Story Meaning', 'Read the sentence and remember the meaning.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-grid">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image" id="activityImage">
                    </div>
                    <div class="sentence-description" id="sentenceText"></div>
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
const sentenceData = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function highlightText(sentence, highlights) {
    if (!highlights || highlights.length === 0) return sentence;
    highlights.forEach(h => {
        sentence = sentence.replace(new RegExp(h.text, 'g'), `<span style="color:${h.color}">${h.text}</span>`);
    });
    return sentence;
}

function updateActivity() {
    const item = sentenceData[currentIndex];
    document.getElementById('activityImage').src = '<?php echo BASE_PATH; ?>' + item.image;
    document.getElementById('sentenceText').innerHTML = highlightText(item.sentence, item.highlights);
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    
    updateActivity();
    
    prevBtn?.addEventListener('click', () => {
        if (currentIndex > 0) { currentIndex--; updateActivity(); }
    });
    
    nextBtn?.addEventListener('click', () => {
        if (currentIndex < sentenceData.length - 1) { currentIndex++; updateActivity(); }
    });
});
</script>