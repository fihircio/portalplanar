<x-app-layout>
    <div class="bg-gray-800 text-white">
        <!-- Hero Section -->
        <div class="py-16">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold mb-4">Welcome to PlanAR</h1>
                <p class="text-lg">Thank you for visiting our home page. We're excited to have you here.</p>
                <p class="text-lg">Feel free to explore and discover more about what we have to offer.</p>
            </div>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold mb-6">Our Features</h2>

            <!-- 2x2 Centered Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Feature 1</h3>
                    <p class="text-gray-600">Description of feature 1.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Feature 2</h3>
                    <p class="text-gray-600">Description of feature 2.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Feature 3</h3>
                    <p class="text-gray-600">Description of feature 3.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Feature 4</h3>
                    <p class="text-gray-600">Description of feature 4.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold mb-6">Our Stats</h2>

            <!-- 1x3 Grid List -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                <!-- Stat 1 -->
                <div class="bg-white p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Stat 1</h3>
                    <p class="text-gray-600">Description of stat 1.</p>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Stat 2</h3>
                    <p class="text-gray-600">Description of stat 2.</p>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Stat 3</h3>
                    <p class="text-gray-600">Description of stat 3.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Section -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold mb-6">Our Pricing</h2>

            <!-- 1x2 Grid List for Pricing -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Pricing Plan 1 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Basic Plan</h3>
                    <p class="text-gray-600">Description of the basic plan.</p>
                    <p class="text-2xl font-bold mt-4">$19.99/month</p>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md mt-4">Subscribe</button>
                </div>

                <!-- Pricing Plan 2 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Premium Plan</h3>
                    <p class="text-gray-600">Description of the premium plan.</p>
                    <p class="text-2xl font-bold mt-4">$39.99/month</p>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md mt-4">Subscribe</button>
                </div>
            </div>
        </div>
    </div>



    <x-footer />
</x-app-layout>
