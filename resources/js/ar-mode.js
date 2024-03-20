document.addEventListener('DOMContentLoaded', function () {
    console.log('armode loaded');
    
    function openARModePopup () {
        const arPopup = document.getElementById('ar-popup');
    
        if (arPopup) {
            arPopup.style.display = 'block';
        }
    }
    
    function closeARModePopup () {
        const arPopup = document.getElementById('ar-popup');
    
        if (arPopup) {
            arPopup.style.display = 'none';
        }
    }
    
    function generateQRCode(mode, contentId) {
        // Call the Laravel route to generate QR code URL
        axios.post('/generate-qrcode', { contentId, mode })
            .then(response => {
                console.log('Response:', response);
                // Get the generated QR code URL
                const qrCodeURL = response.data.qrCodeURL;
    
                // Display the QR code URL or use it as needed
                console.log('QR Code URL:', qrCodeURL);
                // Example: display QR code image
                document.getElementById('qr-code-image').src = qrCodeURL;
            })
            .catch(error => {
                console.error('Failed to generate QR code:', error);
            });
    }
    
    window.openARModePopup = openARModePopup;
    window.closeARModePopup = closeARModePopup;
    window.generateQRCode = generateQRCode;
});
