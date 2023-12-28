<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Content') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Notification Bar -->
                    <div x-data="{ isOpen: true }" x-show="isOpen" class="bg-blue-500 text-white p-4">
                        <div class="flex justify-between items-center">
                            <p>Your notification message goes here.</p>
                            <button @click="isOpen = false" class="text-white">&times;</button>
                        </div>
                    </div>
                    <!-- Search Box -->
                <div class="mb-4 flex items-center">
                    <input
                        type="text"
                        placeholder="Search by title or description..."
                        class="px-4 py-2 border border-gray-300 rounded-md w-full text-black"
                        wire:model="search"
                    >
                    <button
                        class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md"
                        wire:click="search"
                    >
                        Search
                    </button>
                </div>


                    @if($contentItems->isEmpty())
                        <!-- Empty state -->
                        <div id="empty-state" class="border-dashed border-2 p-6 rounded-md cursor-move">
                        <p class="text-lg">You don't have any content yet. Start by adding some!</p>
                    @else
                    <!-- Add your grid list component here -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    @foreach($contentItems as $contentItem)
                        <!-- Example content item -->
                        <div class="bg-gray-100 p-4 rounded-md">

                                    
                        <div class="model-container" id="model-container-{{ $contentItem->id }}" data-model-path="{{ asset( $contentItem->model_path) }}"></div>  
                                         
                            <!-- Content item details -->
                            <h4 class="text-lg font-semibold mb-2 text-black">{{ $contentItem->title }}</h4>
                            <p class="text-gray-600">{{ $contentItem->description }}</p>

                            <!-- Download and Delete buttons -->
                            <div class="mt-4 flex space-x-4">
                                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Download</button>
                                <button class="px-2 py-1 bg-red-500 text-white rounded-md" data-content-id="{{ $contentItem->id }}" onclick="confirmDeleteContent(this)">Delete</button>
                            </div>
                            <!-- Add more details or buttons as needed -->
                            
                        </div>
                        
                    @endforeach
                     <!-- Empty state -->
                     <div id="empty-state" class="flex flex-col items-center justify-center border-dashed border-2 p-6 rounded-md cursor-move">
                            <p class="text-lg">Add more 3D model</p>
                            
                                  <!-- Include the upload modal component -->
                            <x-upload-modal />
                        <!-- Repeat the above block for each content item -->
                        <!-- Add more content items as needed -->

                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
