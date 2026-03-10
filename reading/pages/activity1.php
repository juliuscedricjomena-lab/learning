<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'title' => 'How Meteorologists Predict Weather',
        'content' => 'A meteorologist is a scientist who studies weather and the atmosphere. They collect data from satellites, weather balloons, and radar. This information helps them understand temperature, wind, and humidity. Using it, they make forecasts about upcoming weather.A meteorologist is a scientist who studies weather and the atmosphere. They collect data from satellites, weather balloons, and radar. This information helps them understand temperature, wind, and humidity. Using it, they make forecasts about upcoming weather. A meteorologist is a scientist who studies weather and the atmosphere. They collect data from satellites, weather balloons, and radar. This information helps them understand temperature, wind, and humidity. Using it, they make forecasts about upcoming weather.'
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image2.png',
        'title' => 'How Meteorologists Predict Weather',
        'content' => 'Computers are very important for predicting the weather. Meteorologists use special programs that model the movement of air and clouds. These programs show where rain or storms may form. The data is updated often to give accurate reports.'
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/image3.png',
        'title' => 'How Meteorologists Predict Weather',
        'content' => 'Weather forecasting helps keep people safe. It guides pilots, farmers, and rescue teams in their work. By studying climate change, meteorologists learn how global warming affects the Earth. Their research helps us prepare for extreme weather in the future.'
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1: Read to Learn', 'Use your ears to hear and learn the story.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-flex">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image">
                    </div>
                    <div class="reading-content-container">
                        <div class="reading-title"><?php echo $data[0]['title']; ?></div>
                        <div class="reading-description" id="sentenceDescription">
                            <?php echo $data[0]['content']; ?>
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

function updateWord(index) {
    const activityImage = document.querySelector('.activity-image-container img');
    const readingTitle = document.querySelector('.reading-title');
    const sentenceDescription = document.getElementById('sentenceDescription');
    
    if (activityImage && readingTitle && sentenceDescription && wordData[index]) {
        activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[index].image;
        readingTitle.textContent = wordData[index].title;
        sentenceDescription.textContent = wordData[index].content;
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
