<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 1: Look & Tell', 'Use your eyes to look. Say what you see.'); ?>
            <div class="panel-content-wrapper panel-centered">
                <img src="<?php echo BASE_PATH; ?>images/gallery/image1.png" alt="Activity Image" class="gallery-image">
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
const img = document.querySelector('.panel-content-wrapper img');

let currentImage = 1;

prevBtn?.addEventListener('click', () => {
    if (currentImage > 1) {
        currentImage--;
        img.src = '<?php echo BASE_PATH; ?>images/gallery/image' + currentImage + '.png';
    }
});

nextBtn?.addEventListener('click', () => {
    if (currentImage < 2) {
        currentImage++;
        img.src = '<?php echo BASE_PATH; ?>images/gallery/image' + currentImage + '.png';
    }
});
</script>