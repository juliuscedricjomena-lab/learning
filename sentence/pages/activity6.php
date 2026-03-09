<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'words' => [
           [
            'id' => 1,
            'order' => 3,
            'sentence' => 'who studies the weather'
           ],
           [
            'id' => 2,
            'order' => 1,
            'sentence' => 'A meteorologist'
           ],
           [
            'id' => 3,
            'order' => 2,
            'sentence' => 'is a scientist'
           ]
        ]
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image1.png',
        'words' => [
           [
            'id' => 4,
            'order' => 3,
            'sentence' => 'for predicting the weather'
           ],
           [
            'id' => 5,
            'order' => 1,
            'sentence' => 'Computers'
           ],
           [
            'id' => 6,
            'order' => 2,
            'sentence' => 'are very important'
           ]
        ]
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 6: Sentence Order Recall', 'Drag the sentences into the correct order.'); ?>
            <div class="panel-content-wrapper">
                <div class="activity-content-flex">
                    <div class="activity-image-container">
                        <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Activity Image" id="activityImage">
                    </div>
                    <div class="sentence-description">
                        <div class="draggable-words" id="draggableWords">
                            <?php foreach($data[0]['words'] as $word): ?>
                                <div class="word-item" data-order="<?php echo $word['order']; ?>">
                                    <?php echo $word['sentence']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="drop-zones" id="dropZones">
                            <div class="drop-zone" data-position="1"></div>
                            <div class="drop-zone" data-position="2"></div>
                            <div class="drop-zone" data-position="3"></div>
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
let draggedElement = null;

function updateActivity() {
    const activityImage = document.getElementById('activityImage');
    const draggableWords = document.getElementById('draggableWords');
    const dropZonesContainer = document.getElementById('dropZones');
    
    activityImage.src = '<?php echo BASE_PATH; ?>' + wordData[currentIndex].image;
    
    draggableWords.innerHTML = wordData[currentIndex].words.map(word => 
        `<div class="word-item" data-order="${word.order}">${word.sentence}</div>`
    ).join('');
    
    dropZonesContainer.innerHTML = wordData[currentIndex].words.map((_, index) => 
        `<div class="drop-zone" data-position="${index + 1}"></div>`
    ).join('');
    
    initDragAndDrop();
}

function initDragAndDrop() {
    const dropZones = document.querySelectorAll('.drop-zone');
    const wordItems = document.querySelectorAll('.word-item');
    let isDragging = false;
    
    if (wordItems.length > 0) {
        const firstItem = wordItems[0];
        const rect = firstItem.getBoundingClientRect();
        const itemWidth = rect.width + 'px';
        const itemHeight = rect.height + 'px';
        
        dropZones.forEach(zone => {
            zone.style.width = itemWidth;
            zone.style.minHeight = itemHeight;
        });
    }
    
    function checkAllCorrect() {
        const allCorrect = Array.from(dropZones).every(zone => zone.classList.contains('correct'));
        if (allCorrect && currentIndex < wordData.length - 1) {
            setTimeout(() => {
                currentIndex++;
                updateActivity();
            }, 500);
        }
    }
    
    wordItems.forEach(option => {
        option.addEventListener('mousedown', handleStart);
        option.addEventListener('touchstart', handleStart);
    });
    
    function handleStart(event) {
        const option = event.currentTarget;
        if (!option || isDragging) return;
        
        const parentZone = option.closest('.drop-zone');
        if (parentZone && parentZone.classList.contains('correct')) return;
        
        isDragging = true;
        event.preventDefault();
        
        if (parentZone) {
            parentZone.classList.remove('filled', 'correct', 'incorrect');
        }
        
        let currentDroppable = null;
        let rect = option.getBoundingClientRect();
        let clientX = event.clientX || event.touches[0].clientX;
        let clientY = event.clientY || event.touches[0].clientY;
        let shiftX = clientX - rect.left;
        let shiftY = clientY - rect.top;
        
        const currentWidth = rect.width + 'px';
        const currentHeight = rect.height + 'px';
        
        option.style.position = 'absolute';
        option.style.zIndex = 1000;
        option.style.width = currentWidth;
        option.classList.add('dragging');
        document.body.append(option);
        
        moveAt(clientX, clientY);
        
        function moveAt(clientX, clientY) {
            option.style.left = clientX - shiftX + 'px';
            option.style.top = clientY - shiftY + 'px';
        }
        
        function onMove(event) {
            let moveClientX = event.clientX || event.touches[0].clientX;
            let moveClientY = event.clientY || event.touches[0].clientY;
            
            moveAt(moveClientX, moveClientY);
            
            option.hidden = true;
            let elemBelow = document.elementFromPoint(moveClientX, moveClientY);
            option.hidden = false;
            
            if (!elemBelow) return;
            
            let droppableBelow = elemBelow.closest('.drop-zone');
            
            if (currentDroppable != droppableBelow) {
                if (currentDroppable) currentDroppable.classList.remove('drag-over');
                currentDroppable = droppableBelow;
                if (currentDroppable) currentDroppable.classList.add('drag-over');
            }
        }
        
        function endDrag() {
            document.removeEventListener('mousemove', onMove);
            document.removeEventListener('touchmove', onMove);
            document.removeEventListener('mouseup', endDrag);
            document.removeEventListener('touchend', endDrag);
            
            option.classList.remove('dragging');
            option.style.position = '';
            option.style.zIndex = '';
            option.style.left = '';
            option.style.top = '';
            option.style.width = '';
            
            if (currentDroppable && !currentDroppable.querySelector('.word-item')) {
                currentDroppable.classList.remove('drag-over');
                currentDroppable.innerHTML = '';
                currentDroppable.appendChild(option);
                currentDroppable.classList.add('filled');
                
                const correctOrder = parseInt(option.dataset.order);
                const droppedPosition = parseInt(currentDroppable.dataset.position);
                
                if (correctOrder === droppedPosition) {
                    currentDroppable.classList.add('correct');
                    checkAllCorrect();
                } else {
                    currentDroppable.classList.add('incorrect');
                }
            } else {
                document.getElementById('draggableWords').appendChild(option);
            }
            
            dropZones.forEach(z => z.classList.remove('drag-over'));
            isDragging = false;
        }
        
        document.addEventListener('mousemove', onMove);
        document.addEventListener('touchmove', onMove);
        document.addEventListener('mouseup', endDrag);
        document.addEventListener('touchend', endDrag);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    
    initDragAndDrop();
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateActivity();
            }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentIndex < wordData.length - 1) {
                currentIndex++;
                updateActivity();
            }
        });
    }
});
</script>
