import QrScanner from 'qr-scanner'; 

if(!window.REDIRECT_AFTER_QR_SCANNED) {
    window.REDIRECT_AFTER_QR_SCANNED = function(invitation_key) {
        return `/invitations/${invitation_key}/scan`;
    };
}

const videoElem = document.getElementById('scanner-camera');
const cameraChoice = document.getElementById('scanner-camera-choice');

const onResult = result => {
    if(/^[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}$/.test(result)) {
        qrScanner.stop();
        console.log('decoded qr code:', result)
        window.location.href = REDIRECT_AFTER_QR_SCANNED(result)
    } else {
        console.log('Invalid QR code');
        notify.error(`QR code invalide`, true);
    }
};

const params = {};
if(window.lc.getItem('camera')) {
    params['preferredCamera'] = window.lc.getItem('camera');
}

const qrScanner = new QrScanner(videoElem, onResult, params);
qrScanner.start();


QrScanner.listCameras(true).then(cameras=>{
    for(const camera of cameras) {
        let camEl = document.createElement('option');
        camEl.innerText = camera.label;
        camEl.value = camera.id;
        if(params['preferredCamera'] && params['preferredCamera']==camera.id) {
            camEl.selected = true;
        }
        cameraChoice.appendChild(camEl);
    }
    
    cameraChoice.addEventListener('change', ()=>{
        qrScanner.setCamera(cameraChoice.value);
        window.lc.setItem('camera', cameraChoice.value);
    })
})

