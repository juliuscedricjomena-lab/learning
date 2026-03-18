console.log('Kinder Reading Learning loaded');

window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'none';
    
    const slider = document.querySelector('.speed-slider');
    if (slider) {
        function updateSlider() {
            const value = (slider.value - slider.min) / (slider.max - slider.min) * 100;
            slider.style.background = `linear-gradient(to right, #86C441 0%, #86C441 ${value}%, #ccc ${value}%, #ccc 100%)`;
        }
        slider.addEventListener('input', updateSlider);
        updateSlider();
    }
    
    const itemsSlider = document.getElementById('itemsSlider');
    const itemsValue = document.getElementById('itemsValue');
    if (itemsSlider && itemsValue) {
        function updateItemsSlider() {
            const value = (itemsSlider.value - itemsSlider.min) / (itemsSlider.max - itemsSlider.min) * 100;
            itemsSlider.style.background = `linear-gradient(to right, #86C441 0%, #86C441 ${value}%, #ccc ${value}%, #ccc 100%)`;
            itemsValue.textContent = itemsSlider.value;
            const sliderWidth = itemsSlider.offsetWidth;
            const thumbWidth = 32;
            const thumbPosition = (value / 100) * (sliderWidth - thumbWidth) + (thumbWidth / 2);
            itemsValue.style.left = `${thumbPosition - 16}px`;
        }
        itemsSlider.addEventListener('input', updateItemsSlider);
        updateItemsSlider();
    }
});

window.addEventListener('pageshow', (event) => {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'none';
});


document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', (e) => {
        if (link.href && !link.href.startsWith('#')) {
            const loader = document.getElementById('loader');
            if (loader) loader.style.display = 'flex';
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const collapseBtn = document.getElementById('collapseBtn');
    const expandBtn = document.getElementById('expandBtn');
    const panelRight = document.getElementById('panelRight');
    const panelCollapsed = document.getElementById('panelCollapsed');
    const panelLeft = document.querySelector('.panel-left');
    
    if (collapseBtn && expandBtn && panelRight && panelCollapsed && panelLeft) {
        collapseBtn.addEventListener('click', function() {
            panelRight.style.transition = 'opacity 0.3s';
            panelRight.style.opacity = '0';
            setTimeout(() => {
                panelRight.style.display = 'none';
                panelCollapsed.style.display = 'flex';
                panelLeft.classList.add('expanded');
            }, 300);
        });
        
        expandBtn.addEventListener('click', function() {
            panelCollapsed.style.display = 'none';
            panelRight.style.display = 'flex';
            panelLeft.classList.remove('expanded');
            setTimeout(() => {
                panelRight.style.opacity = '1';
            }, 10);
        });
    }
});
