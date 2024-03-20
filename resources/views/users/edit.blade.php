<x-app-layout>
    <!-- Top Navigation Bar -->
    <div class="bg-white border-b border-gray-200 p-4">
        @include('layouts.topnavigation')
    </div>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')
        <div class="flex-1 overflow-hidden">    
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit User Role') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <!-- Form to update user role -->
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="role" class="block text-sm font-medium leading-5 text-gray-700">Role</label>
                                    <select id="role" name="role" class="mt-1 form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="admin" @if(optional($user->role)->name === 'admin') selected @endif>Admin</option>
                                        <option value="staff" @if(optional($user->role)->name === 'staff') selected @endif>Staff</option>
                                    </select>
                                </div>

                                <div class="mt-4 text-right">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-indigo-700 text-base leading-6 font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>
