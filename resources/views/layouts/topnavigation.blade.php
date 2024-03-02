<!-- Top Navigation Bar -->
<div class="flex items-center justify-between">
    <!-- Logo -->
    <div class="mb-4 mr-4 text-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo class="block w-auto h-10 text-gray-600 fill-current"/>
            </a>
        </div>

@auth
        <!-- Credits Left -->
        <div class="flex items-center text-sm ">
        <div class="mb-4 mr-4 text-center">
            <p class="text-sm text-gray-400">Credits Left</p>
            <p class="ml-2 text-blue-500 font-bold">{{ Auth::user()->credits }}</p>
        </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

    @else
    <div class="flex items-center">
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline dark:text-gray-500">Register</a>
        @endif
    @endauth
    </div>
    </div>
