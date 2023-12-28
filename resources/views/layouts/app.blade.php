<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
         <!-- Add tailwindcss line for hiding/showing the sidebar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <!--3js 3D model-->
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/FBXLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/MTLLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/OBJLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/libs/fflate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
       <!--upload function-->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script>
        <!--display 3d model on content/grid-->
        <script src="{{ asset('js/3dcontent.js') }}"></script>
       <!--add new data inside row-->
        <script src="{{ asset('js/data.js') }}"></script>
        <!--social media icon-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- local & sketchfab 3d model upload-->
        <script src="{{ asset('js/upload-model.js') }}"></script>
        <!-- Confirm delete data popup -->
        <script src="{{ asset('js/confirm-delete.js') }}"></script>
        <!-- Add new data popup -->
        <script src="{{ asset('js/confirm-data.js') }}"></script>
         <!-- Confirm delete content  -->
         <script src="{{ asset('js/content-delete.js') }}"></script>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
        function toggleSidebar() {
            document.body.classList.toggle('sidebar-open');
        }
    </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            
            <!-- Hamburger button -->
        <button onclick="toggleSidebar()" class="fixed top-4 left-4 p-2 bg-gray-800 text-white rounded-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>


       
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-gray-800">
                {{ $slot }}
            </main>
        </div>
    </body>

    
</html>
