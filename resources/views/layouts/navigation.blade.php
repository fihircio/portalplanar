<nav x-data="{ open: false }" class="flex h-screen bg-gray-100">
    <!-- Primary Navigation Menu Sidebar -->
    <div class="bg-white border-r border-gray-200">
        
        <!-- Navigation Links -->
        <div class="flex flex-col">
      
           
        <!-- Add the following line for the dashboard link -->
            @auth

            
                <x-nav-link :href="route('dashboard.index')" :active="request()->routeIs('dashboard.index')" class="mt-2"> 
                {{ __('Dashboard') }}
                </x-nav-link>
           

                 <!-- AR Creation Title -->
                <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800">AR Creation</h3>
                </div>
                
            
                <x-nav-link :href="route('content.index')" :active="request()->routeIs('content.index')" class="mt-2">
                {{ __('Content') }}
                </x-nav-link>
                
                <x-nav-link :href="route('data.index')" :active="request()->routeIs('data.index')" class="mt-2">
                    {{ __('Data') }}
                </x-nav-link>
                  <!-- Users Management Title -->
                  <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">Users Management</h3>
                </div>

           
                <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" class="mt-2">
                    {{ __('Users') }}
                </x-nav-link>
           
            @endauth
        </div>
    </div>
    
</nav>
