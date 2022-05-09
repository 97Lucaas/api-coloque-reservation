import QrScanner from 'qr-scanner'; 

const videoElem = document.getElementById('scanner-camera');
const cameraChoice = document.getElementById('scanner-camera-choice');

const qrScanner = new QrScanner(videoElem, result => {
    qrScanner.stop();
    console.log('decoded qr code:', result)
    window.location.href = `/invitations/${result}/scan`
});
qrScanner.start();

QrScanner.listCameras(true).then(cameras=>{
    console.log(cameras);
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

