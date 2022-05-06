import QrScanner from 'qr-scanner'; 

const videoElem = document.getElementById('scanner-camera');
const qrScanner = new QrScanner(videoElem, result => {
    qrScanner.stop();
    console.log('decoded qr code:', result)
    //window.location.href = `/invitations/${result}/scan`
});
qrScanner.start();
