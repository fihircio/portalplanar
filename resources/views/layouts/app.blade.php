<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

       
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/FBXLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/MTLLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/OBJLoader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/controls/OrbitControls.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/libs/fflate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/examples/js/loaders/GLTFLoader.js"></script>
        
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

         <!-- Add tailwindcss line for hiding/showing the sidebar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  
       
        <!--upload function-->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script> 
        <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
        <!--social media icon-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
         <!-- load all js using npx mix-->
         <script src="{{ mix('js/all.js') }}"></script>
    
    </script>
    </head>
    <body class="font-sans antialiased">
    
            
            <!-- Hamburger button 
        <button onclick="toggleSidebar()" class="fixed top-4 left-4 p-2 bg-gray-800 text-white rounded-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>-->


       
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-gray-800">
                {{ $slot }}
            </main>
        </div>
    </body>

    
</html>
