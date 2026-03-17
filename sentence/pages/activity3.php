<?php 
require_once __DIR__ . '/../components/activity-panel.php';
require_once __DIR__ . '/../components/controls.php';

$data = [
    [
        'id' => 1,
        'image' => 'images/gallery/image1.png',
        'english' => 'Laugh',
        'korean' => '웃다'
    ],
    [
        'id' => 2,
        'image' => 'images/gallery/image2.png',
        'english' => 'Ride',
        'korean' => '탈것'
    ]
];
?>
<div class="page-content">
    <img src="<?php echo BASE_PATH; ?>images/prev-btn.png" alt="Previous" class="nav-btn">
    <div class="content-wrapper">
        <?php startActivityPanel('Activity 3: Copy Cat Say', 'Use your ears to listen. Say the word one time.'); ?>
            <div class="panel-content-wrapper">
                <div class="panel-left expanded">
                    <div class="activity-record-layout">
                        <div class="activity-record-left">
                            <h1 class="opacity-50" style="color: white;"><?php echo $data[0]['english']; ?></h1>
                            <img src="<?php echo BASE_PATH . $data[0]['image']; ?>" alt="Word" id="wordImage" class="activity-record-image">
                        </div>
                        <div class="activity-record-right">
                            <div class="activity-record-words">
                                <div class="activity-record-english" id="wordEnglish"><?php echo $data[0]['english']; ?></div>
                                <div class="activity-record-korean" id="wordKorean"><?php echo $data[0]['korean']; ?></div>
                            </div>
                            <div class="activity-record-recording">
                                <div class="mic-selector">
                                    <select id="micSelect" class="mic-dropdown"></select>
                                </div>
                                <div class="record-controls">
                                    <span id="recIndicator" class="rec-indicator">[ <span class="rec-dot"></span>REC ]</span>
                                    <button class="mic-btn" id="micBtn">
                                        <img src="<?php echo BASE_PATH; ?>images/mic-btn.png" alt="Microphone" class="mic-icon">
                                    </button>
                                    <div class="volume-waves">
                                        <?php for ($i = 0; $i < 20; $i++): ?><span class="wave"></span><?php endfor; ?>
                                    </div>
                                    <button class="rec-btn" id="viewRecordingsBtn">
                                        <img src="<?php echo BASE_PATH; ?>images/icons/folder.png" alt="Recordings" style="width: 24px; height: 24px;">
                                    </button>
                                </div>
                            </div>
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

<div id="toast" class="toast"></div>

<div id="recordingsModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Recordings</h2>
        <div id="recordingsList" class="recordings-list"></div>
        <div class="modal-buttons">
            <button class="modal-btn modal-back" id="modalBack">Back</button>
        </div>
    </div>
</div>

<div id="recordingDetailModal" class="modal" style="display: none;">
    <div class="modal-content">
        <img src="<?php echo BASE_PATH; ?>images/sound-icon.png" alt="Sound" class="modal-sound-icon">
        <div class="recording-name" id="recordingName"></div>
        <div class="modal-buttons">
            <button class="modal-btn modal-back" id="detailModalBack">Back</button>
            <button class="modal-btn modal-submit" id="detailModalSubmit">Submit</button>
        </div>
    </div>
</div>

<script>
const wordData = <?php echo json_encode($data); ?>;
let currentIndex = 0;

function updateWord(index) {
    const wordImage = document.getElementById('wordImage');
    const wordKorean = document.getElementById('wordKorean');
    const wordEnglish = document.getElementById('wordEnglish');
    const wordHeader = document.querySelector('.activity-record-left .opacity-50');
    
    if (wordImage && wordKorean && wordEnglish && wordData[index]) {
        wordImage.src = wordData[index].image;
        wordKorean.textContent = wordData[index].korean;
        wordEnglish.textContent = wordData[index].english;
        if (wordHeader) wordHeader.textContent = wordData[index].english;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.querySelector('.nav-btn[alt="Previous"]');
    const nextBtn = document.querySelector('.nav-btn[alt="Next"]');
    const micBtn = document.getElementById('micBtn');
    const recIndicator = document.getElementById('recIndicator');
    const volumeWaves = document.querySelector('.volume-waves');
    const micSelect = document.getElementById('micSelect');
    let isRecording = false;
    let mediaRecorder;
    let audioChunks = [];
    let audioContext;
    let analyser;
    let microphone;
    let animationId;
    let recordingTimeout;
    let selectedMicId = null;
    
    async function loadMicrophones() {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const audioInputs = devices.filter(device => device.kind === 'audioinput');
        
        micSelect.innerHTML = audioInputs.map(device => 
            `<option value="${device.deviceId}">${device.label || 'Microphone ' + (audioInputs.indexOf(device) + 1)}</option>`
        ).join('');
        
        if (audioInputs.length > 0) {
            selectedMicId = audioInputs[0].deviceId;
        }
    }
    
    micSelect.addEventListener('change', function() {
        selectedMicId = this.value;
    });
    
    loadMicrophones();
    
    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
    
    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state !== 'inactive') {
            mediaRecorder.stop();
        }
        isRecording = false;
        recIndicator.style.display = 'none';
        recIndicator.classList.remove('recording');
        volumeWaves.classList.remove('animating');
        if (animationId) cancelAnimationFrame(animationId);
        if (recordingTimeout) clearTimeout(recordingTimeout);
    }
    
    if (micBtn) {
        micBtn.addEventListener('click', async function() {
            if (!isRecording) {
                try {
                    const constraints = { 
                        audio: selectedMicId ? { deviceId: { exact: selectedMicId } } : true 
                    };
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];
                    
                    audioContext = new AudioContext();
                    analyser = audioContext.createAnalyser();
                    microphone = audioContext.createMediaStreamSource(stream);
                    microphone.connect(analyser);
                    analyser.fftSize = 256;
                    
                    mediaRecorder.ondataavailable = (event) => {
                        audioChunks.push(event.data);
                    };
                    
                    mediaRecorder.onstop = async () => {
                        const audioBlob = new Blob(audioChunks, { type: 'audio/webm' });
                        const formData = new FormData();
                        const currentWord = wordData[currentIndex].english;
                        formData.append('audio', audioBlob);
                        formData.append('word', currentWord);
                        formData.append('activity', 'activity3');
                        
                        const response = await fetch('<?php echo BASE_PATH; ?>save-recording.php', {
                            method: 'POST',
                            body: formData
                        });
                        
                        const result = await response.json();
                        if (result.success) {
                            showToast('Recording saved successfully!');
                        } else {
                            showToast(result.error || 'Failed to save recording');
                        }
                        
                        stream.getTracks().forEach(track => track.stop());
                        if (audioContext) audioContext.close();
                    };
                    
                    mediaRecorder.start();
                    isRecording = true;
                    recIndicator.style.display = 'inline';
                    recIndicator.classList.add('recording');
                    detectVoice();
                    
                    recordingTimeout = setTimeout(() => {
                        stopRecording();
                    }, 30000);
                } catch (err) {
                    console.error('Error accessing microphone:', err);
                }
            } else {
                stopRecording();
            }
        });
    }
    
    function detectVoice() {
        if (!isRecording) return;
        
        const bufferLength = analyser.frequencyBinCount;
        const dataArray = new Uint8Array(bufferLength);
        analyser.getByteFrequencyData(dataArray);
        
        const average = dataArray.reduce((a, b) => a + b) / bufferLength;
        
        if (average > 50) {
            volumeWaves.classList.add('animating');
        } else {
            volumeWaves.classList.remove('animating');
        }
        
        animationId = requestAnimationFrame(detectVoice);
    }
    
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
    
    const viewRecordingsBtn = document.getElementById('viewRecordingsBtn');
    const recordingsModal = document.getElementById('recordingsModal');
    const recordingDetailModal = document.getElementById('recordingDetailModal');
    const modalBack = document.getElementById('modalBack');
    const detailModalBack = document.getElementById('detailModalBack');
    const detailModalSubmit = document.getElementById('detailModalSubmit');
    const recordingsList = document.getElementById('recordingsList');
    const recordingName = document.getElementById('recordingName');
    
    if (viewRecordingsBtn) {
        viewRecordingsBtn.addEventListener('click', async function() {
            const currentWord = wordData[currentIndex].english;
            const response = await fetch(`<?php echo BASE_PATH; ?>get-recordings.php?word=${currentWord}&activity=activity3`);
            const recordings = await response.json();
            
            if (recordings.length === 0) {
                recordingsList.innerHTML = '<div style="text-align: center; padding: 20px; color: #666;">No recordings yet</div>';
            } else {
                recordingsList.innerHTML = recordings.map(rec => 
                    `<div class="recording-item" data-recording="${rec}">${rec}</div>`
                ).join('');
                
                document.querySelectorAll('.recording-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const recName = this.getAttribute('data-recording');
                        recordingName.textContent = recName;
                        recordingsModal.style.display = 'none';
                        recordingDetailModal.style.display = 'flex';
                    });
                });
            }
            
            recordingsModal.style.display = 'flex';
        });
    }
    
    if (modalBack) {
        modalBack.addEventListener('click', function() {
            recordingsModal.style.display = 'none';
        });
    }
    
    if (detailModalBack) {
        detailModalBack.addEventListener('click', function() {
            recordingDetailModal.style.display = 'none';
            recordingsModal.style.display = 'flex';
        });
    }
    
    if (detailModalSubmit) {
        detailModalSubmit.addEventListener('click', function() {
            showToast('Recording submitted!');
            recordingDetailModal.style.display = 'none';
        });
    }
});
</script>
