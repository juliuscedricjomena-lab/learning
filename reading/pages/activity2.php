<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'title' => 'How Meteorologists Predict Weather',
        'content' => 'A meteorologist is a scientist who studies weather and the atmosphere. They collect data from satellites, weather balloons, and radar. This information helps them understand temperature, wind, and humidity. Using it, they make forecasts about upcoming weather.',
        'question' => 'What is the story mostly about?',
        'options' => [
            'Meteorologists study weather and use computers to make forecasts',
            'Farmers planting crops',
            'Pilots flying airplanes',
            'Students doing homework'
        ],
        'correct_option' => 0
    ],
    [
        'id' => 2,
        'title' => 'The Role of Computers in Weather Forecasting',
        'content' => 'Computers are very important for predicting the weather. Meteorologists use special programs that model the movement of air and clouds. These programs show where rain or storms may form. The data is updated often to give accurate reports.',
        'question' => 'Who studies the weather and atmosphere?',
        'options' => [
            'Teachers',
            'Rescue teams',
            'Meteorologists',
            'Shoppers'
        ],
        'correct_option' => 2
    ],
    [
        'id' => 3,
        'title' => 'Why Weather Forecasting Matters',
        'content' => 'Weather forecasting helps keep people safe. It guides pilots, farmers, and rescue teams in their work. By studying climate change, meteorologists learn how global warming affects the Earth. Their research helps us prepare for extreme weather in the future.',
        'question' => 'What tools do meteorologists use to collect information?',
        'options' => [
            'Satellites, balloons, and radar',
            'Toys and games',
            'Books and pencils',
            'Cars and buses'
        ],
        'correct_option' => 0
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 2: Comprehension Check', 'Read the question and choose the best answer.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left">
                    <div class="quiz-question" id="quizQuestion">Q1. <?php echo $data[0]['question']; ?></div>
                    <div class="quiz-options" id="quizOptions">
                        <?php foreach($data[0]['options'] as $i => $option): ?>
                        <div class="quiz-option" data-index="<?php echo $i; ?>">
                            <span class="option-letter"><?php echo chr(65 + $i); ?></span>
                            <span class="option-text"><?php echo $option; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="panel-right-wrapper" id="panelRightWrapper">
                    <div class="collapse-btn" id="collapseBtn">
                        <img src="<?php echo BASE_PATH; ?>images/collapse-btn.png" alt="Collapse">
                    </div>
                    <div class="panel-right" id="panelRight">
                        <div class="reading-title" id="readingTitle"><?php echo $data[0]['title']; ?></div>
                        <div class="reading-content" id="readingContent"><?php echo $data[0]['content']; ?></div>
                    </div>
                </div>
                <div class="panel-collapsed" id="panelCollapsed" style="display: none;">
                    <img src="<?php echo BASE_PATH; ?>images/expand-btn.png" alt="Expand" class="expand-btn" id="expandBtn">
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
const data = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function updateContent(index) {
    const title = document.getElementById('readingTitle');
    const content = document.getElementById('readingContent');
    const question = document.getElementById('quizQuestion');
    const options = document.getElementById('quizOptions');
    
    if (data[index]) {
        title.textContent = data[index].title;
        content.textContent = data[index].content;
        question.textContent = 'Q' + (index + 1) + '. ' + data[index].question;
        
        options.innerHTML = data[index].options.map((opt, i) => 
            `<div class="quiz-option" data-index="${i}">
                <span class="option-letter">${String.fromCharCode(65 + i)}</span>
                <span class="option-text">${opt}</span>
            </div>`
        ).join('');
        
        attachOptionListeners();
    }
}

function attachOptionListeners() {
    document.querySelectorAll('.quiz-option').forEach(option => {
        option.addEventListener('click', function() {
            const selectedIndex = parseInt(this.dataset.index);
            const correctIndex = data[currentIndex].correct_option;
            
            if (selectedIndex === correctIndex) {
                this.style.background = '#4CAF50';
                this.style.boxShadow = '0 4px 0 #2E7D32';
            } else {
                this.style.background = '#F44336';
                this.style.boxShadow = '0 4px 0 #C62828';
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    attachOptionListeners();
    
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) updateContent(--currentIndex);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (currentIndex < data.length - 1) updateContent(++currentIndex);
        });
    }
    
    const collapseBtn = document.getElementById('collapseBtn');
    const expandBtn = document.getElementById('expandBtn');
    const panelRight = document.getElementById('panelRight');
    const panelCollapsed = document.getElementById('panelCollapsed');
    
    collapseBtn?.addEventListener('click', () => {
        const wrapper = document.getElementById('panelRightWrapper');
        wrapper.style.opacity = '0';
        wrapper.style.transform = 'translateX(20px)';
        setTimeout(() => {
            wrapper.style.display = 'none';
            panelCollapsed.style.display = 'flex';
            setTimeout(() => {
                panelCollapsed.style.opacity = '1';
                panelCollapsed.style.transform = 'translateX(0)';
            }, 10);
        }, 300);
    });
    
    expandBtn?.addEventListener('click', () => {
        panelCollapsed.style.opacity = '0';
        panelCollapsed.style.transform = 'translateX(-20px)';
        setTimeout(() => {
            panelCollapsed.style.display = 'none';
            const wrapper = document.getElementById('panelRightWrapper');
            wrapper.style.display = 'flex';
            setTimeout(() => {
                wrapper.style.opacity = '1';
                wrapper.style.transform = 'translateX(0)';
            }, 10);
        }, 300);
    });
});
</script>
