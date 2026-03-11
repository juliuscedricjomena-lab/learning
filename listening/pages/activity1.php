<?php
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'audio' => 'audio/meteorologists-predict-weather.mp3',
        'question' => 'Which title best matches the listening?',
        'type' => 'multiple_choice',
        'options' => ['Meteorologists study weather', 'Farmers plant crops', 'Pilots fly airplanes', 'Students do homework'],
        'correct_answer' => 0
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image1.png',
        'audio' => 'audio/meteorologists-predict-weather.mp3',
        'question' => 'What do meteorologists use to study the weather?',
        'type' => 'multiple_choice',
        'options' => ['Satellites, balloons, and radar', 'Toys and games', 'Books and pencils', 'Cars and buses'],
        'correct_answer' => 0
    ],
    [
        'id' => 3,
        'image' => 'images/gallery/image1.png',
        'audio' => 'audio/meteorologists-predict-weather.mp3',
        'question' => 'Why do meteorologists use computers?',
        'type' => 'multiple_choice',
        'options' => ['To help predict rain and storms', 'To play games', 'To write stories', 'To watch movies'],
        'correct_answer' => 0
    ],
    [
        'id' => 4,
        'image' => 'images/gallery/image1.png',
        'audio' => 'audio/meteorologists-predict-weather.mp3',
        'question' => 'Who gets help from weather forecasts?',
        'type' => 'multiple_choice',
        'options' => ['Pilots, farmers, and rescue teams', 'Shoppers and store owners', 'Musicians and artists', 'Students and teachers'],
        'correct_answer' => 0
    ],
    [
        'id' => 5,
        'image' => 'images/gallery/image1.png',
        'audio' => 'audio/meteorologists-predict-weather.mp3',
        'question' => 'Meteorologists help keep people safe by predicting the weather.',
        'type' => 'true_false',
        'options' => ['True', 'False'],
        'correct_answer' => 0
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1: Listening Comprehension', 'Use your ears to hear and learn the story.'); ?>
        <div class="panel-content-wrapper">
            <div class="activity-content-flex">
                <div class="activity-image-container" style="flex: 0 0 50%;">
                    <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image">
                    <button class="sound-icon-btn" id="soundIconBtn">
                        <img src="<?php echo BASE_PATH; ?>images/sound-icon-white.png" alt="Sound" class="sound-icon-overlay">
                    </button>
                    <audio id="activityAudio" src="<?php echo BASE_PATH . $data[0]['audio']; ?>"></audio>
                </div>
                <div class="quiz-container" style="flex: 0 0 50%;">
                    <div class="quiz-question" id="quizQuestion"><?php echo $data[0]['question']; ?></div>
                    <div class="quiz-options" id="quizOptions">
                        <?php foreach($data[0]['options'] as $index => $option): ?>
                        <div class="quiz-option" data-index="<?php echo $index; ?>">
                            <div class="option-letter"><?php echo chr(65 + $index); ?></div>
                            <div class="option-text"><?php echo $option; ?></div>
                        </div>
                        <?php endforeach; ?>
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
        const activityImage = document.querySelector('.activity-image-container img:first-child');
        const quizQuestion = document.getElementById('quizQuestion');
        const quizOptions = document.getElementById('quizOptions');
        const activityAudio = document.getElementById('activityAudio');

        if (activityImage && quizQuestion && quizOptions && wordData[index]) {
            activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[index].image;
            quizQuestion.textContent = wordData[index].question;
            
            if (activityAudio) {
                activityAudio.src = '<?php echo BASE_PATH; ?>' + wordData[index].audio;
            }
            
            quizOptions.innerHTML = '';
            wordData[index].options.forEach((option, i) => {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'quiz-option';
                optionDiv.dataset.index = i;
                optionDiv.style.pointerEvents = 'auto';
                optionDiv.innerHTML = `
                    <div class="option-letter">${String.fromCharCode(65 + i)}</div>
                    <div class="option-text">${option}</div>
                `;
                quizOptions.appendChild(optionDiv);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
        const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
        const soundIconBtn = document.getElementById('soundIconBtn');
        const activityAudio = document.getElementById('activityAudio');
        const soundIcon = document.querySelector('.sound-icon-overlay');

        if (soundIconBtn && activityAudio) {
            soundIconBtn.addEventListener('click', function() {
                if (activityAudio.paused) {
                    activityAudio.play();
                    soundIcon.classList.add('playing');
                } else {
                    activityAudio.pause();
                    activityAudio.currentTime = 0;
                    soundIcon.classList.remove('playing');
                }
            });

            activityAudio.addEventListener('ended', function() {
                soundIcon.classList.remove('playing');
            });
        }

        document.addEventListener('click', function(e) {
            const option = e.target.closest('.quiz-option');
            if (option && wordData[currentIndex] && !option.classList.contains('correct') && !option.classList.contains('incorrect')) {
                const selectedIndex = parseInt(option.dataset.index);
                const correctIndex = wordData[currentIndex].correct_answer;
                
                const allOptions = document.querySelectorAll('.quiz-option');
                allOptions.forEach(opt => {
                    opt.style.pointerEvents = 'none';
                });
                
                if (selectedIndex === correctIndex) {
                    option.classList.add('correct');
                } else {
                    option.classList.add('incorrect');
                }
            }
        });

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