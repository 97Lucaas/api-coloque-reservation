import QrScanner from 'qr-scanner'; 

const videoElem = document.getElementById('scanner-camera');
const cameraChoice = document.getElementById('scanner-camera-choice');

const qrScanner = new QrScanner(videoElem, result => {
    if(/^[a-f0-9]{8}\-[a-f0-9]{4}\-4[a-f0-9]{3}\-(8|9|a|b)[a-f0-9]{3}\-[a-f0-9]{12}$/.test(result)) {
        qrScanner.stop();
        console.log('decoded qr code:', result)
        window.location.href = `/invitations/${result}/scan`
    } else {
        console.log('Invalid QR code');
        notify.error(`QR code invalide`, true);
    }
});
qrScanner.start();


QrScanner.listCameras(true).then(cameras=>{
    for(const camera of cameras) {
        let camEl = document.createElement('option');
        camEl.innerText = camera.label;
        camEl.value = camera.id;
        cameraChoice.appendChild(camEl);
        
    }
    cameraChoice.addEventListener('change', ()=>{
        qrScanner.setCamera(cameraChoice.value)
    })
})

