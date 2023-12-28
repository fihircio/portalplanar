<div x-data="{ isOpen: false }">
    <!-- Button to open the modal -->
    <button @click="isOpen = true" class="bg-green-500 text-white px-4 py-2 rounded-md">+</button>

    <!-- The Modal -->
    <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex items-center justify-center">
        <div class="relative p-8 bg-white w-1/2 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Choose a 3D Asset</h2>
            <p class="text-gray-600 mb-4">Upload your own 3D model, video, or image (max. 25MB).</p>

            <!-- File Upload Form -->
            <form action="{{ route('content.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                <input type="text" name="title" id="title" class="mt-1 p-2 border rounded-md text-black">
            </div>

            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" class="mt-1 p-2 border rounded-md text-black"></textarea>
            </div>
            <!-- File Upload -->
            <div class="mb-4">
                    <label for="model-file" class="block text-sm font-medium text-gray-700">Upload Model (GLB/GLTF):</label>
                    <input type="file" name="model_file" id="model-file" class="mt-1 p-2 border rounded-md text-black">
            </div>

            <!-- Sketchfab Upload -->
            <div class="mb-4">
                    <label for="sketchfab-input" class="block text-sm font-medium text-gray-700">Sketchfab Model URL/ID:</label>
                    <input type="text" name="sketchfab_input" id="sketchfab-input" class="mt-1 p-2 border rounded-md text-black">
            </div>  
            
   
            <!-- Buttons -->
            <div class="flex justify-end">
                <button @click="isOpen = false" class="mr-2 bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>

