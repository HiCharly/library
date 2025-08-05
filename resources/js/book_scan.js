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

    return await codeReader.decodeFromVideoDevice(selectedDeviceId, previewElem, (result, error, controls) => {
        if (result) {
            const event = new CustomEvent('book-scanned', { detail: { barcode: result.getText() } });
            window.dispatchEvent(event);
            controls.stop();
        }
    });
}
