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
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
        
        <div class="py-12"> 
            <!-- Notification Bar -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div x-data="{ isOpen: true }" x-show="isOpen" class="bg-blue-500 text-white p-4 mb-4">
                    <div class="flex justify-between items-center">
                        <p>Your notification message goes here.</p>
                        <button @click="isOpen = false" class="text-white">&times;</button>
                    </div>
                </div>
            </div>
        
            <!-- Centered Grid List -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-2xl font-semibold mb-4 text-black">Counter</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    
                    <div class="bg-blue-100 p-6 rounded-md">
                        <h2 class="text-4xl font-semibold mb-4 text-black">Content</h2>
                        <p class="text-gray-600">Total: {{ $contentCount }}</p>
                        <!-- Add more details or buttons as needed -->
                    </div>

                    <div class="bg-red-100 p-6 rounded-md">
                        <h2 class="text-4xl font-semibold mb-4 text-black">Data</h2>
                        <p class="text-gray-600">Total: {{ $dataCount }}</p>
                        <!-- Add more details or buttons as needed -->
                    </div>

                    <div class="bg-green-100 p-6 rounded-md">
                        <h2 class="text-4xl font-semibold mb-4 text-black">Users</h2>
                        <p class="text-gray-600">Total: {{ $userCount }}</p>
                        <!-- Add more details or buttons as needed -->
                    </div> 

                </div>
            </div>

            <!-- Audit Trail Feed -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <h2 class="text-2xl font-semibold mb-4 text-black">Audit Trail</h2>

                    <table class="min-w-full divide-y divide-gray-200 0 mb-8">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Activity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 0">
                            @foreach($auditTrails as $auditTrail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $auditTrail->activity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $auditTrail->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $auditTrail->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>     
        </div>
    </div>
    <x-footer />
</x-app-layout>
