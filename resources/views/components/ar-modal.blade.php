<div x-data="{ isOpen: false, selectedTab: 'floor', qrCodeURL: '' }">
    <!-- Button to open the modal -->
    <button @click="isOpen = true; generateQRCode(selectedTab, contentId)" class="bg-green-500 text-white px-4 py-2 rounded-md">AR Mode</button>

    <!-- The Modal -->
    <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex items-center justify-center">
        <div class="relative p-8 bg-white w-1/2 rounded-lg">
            <h2 class="text-gray-600 font-bold mb-4">Select AR Mode</h2>
            <p class="text-gray-600 mb-4">View AR by scanning the QR code</p>
            
            <!-- Tab Buttons -->
            <div class="flex mb-4">
                <button 
                    @click="selectedTab = 'floor'; generateQRCode(selectedTab, contentId)"
                    :class="{ 'bg-blue-500 text-white': selectedTab === 'floor', 'bg-gray-200': selectedTab !== 'floor' }"
                    class="px-4 py-2 rounded-md mr-4"
                >
                    Surface Mode
                </button>
                <button 
                    @click="selectedTab = 'image'; generateQRCode(selectedTab, contentId)"
                    :class="{ 'bg-blue-500 text-white': selectedTab === 'image', 'bg-gray-200': selectedTab !== 'image' }"
                    class="px-4 py-2 rounded-md"
                >
                    Marker Mode
                </button>
            </div>

            <!-- QR Code Placeholder -->
            <div class="text-gray-600 flex justify-center mb-4">
                <img :src="qrCodeURL" alt="QR Code" class="w-32 h-32" x-show="qrCodeURL !== ''">
                <p x-show="qrCodeURL === ''">Generating QR code...</p>
            </div>

            <!-- Content for selected tab -->
            <div x-show="selectedTab === 'floor'" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                <button @click="generateQRCode('floor', contentId)">Surface Mode</button>
            </div>

            <div x-show="selectedTab === 'image'" class="px-4 py-2 bg-blue-500 text-white rounded-md">
                <button @click="generateQRCode('image', contentId)">Marker Mode</button>
            </div>

            <!-- Cancel Button -->
            <div class="flex justify-end">
                <button @click="isOpen = false" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
    function generateQRCode(mode, contentId) {
        const qr = new QRious({
            element: document.getElementById('qr-code-canvas'),
            value: `https://portalplanar.eeelab.www/ar-viewer?mode=${mode}&contentId=${contentId}`,
            size: 200
        });
    }
</script>