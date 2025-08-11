import { BrowserMultiFormatReader } from '@zxing/browser';
window.BrowserMultiFormatReader = BrowserMultiFormatReader;

window.bookScan = async function() {
    const codeReader = new BrowserMultiFormatReader();

    const previewElem = document.querySelector('#video');

    const videoInputDevices = await BrowserMultiFormatReader.listVideoInputDevices();
    const backCamera = videoInputDevices.find(device =>
        device.label.toLowerCase().includes('back')
    ) || videoInputDevices[0];
    const selectedDeviceId = backCamera.deviceId;

    // Start decoding
    const controls = await codeReader.decodeFromVideoDevice(
        selectedDeviceId,
        previewElem,
        (result, error, ctrl) => {
            if (result) {
                window.dispatchEvent(new CustomEvent('book-scanned', {
                    detail: { barcode: result.getText() }
                }));
                ctrl.stop(); // Stop camera after success
            }
        }
    );

    return controls; // Allow Alpine to call .stop() manually on modal close
}
