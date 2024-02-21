<x-app-layout>
    <div class="bg-gray-800 text-white">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-8">
                    <div>      
                    <h2 class="text-4xl font-bold mb-4"> Welcome to PlanAR, where the future of construction comes to life</h1>
                    <p class="text-lg">Redefining Construction Excellence Through Digital Innovation</p>               
                </div>      
                
                <div>
                    <img src="{{ asset('storage/images/banner.jpg') }}" alt="Image Description" class="w-full h-auto rounded-md">
                </div>  
            </div>

            
        </div>
        
    </div>

    
    

    <!-- New Section with Text and Image -->
    <div class="bg-white dark:bg-gray-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-8">
                <!-- Text on the left -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Precision Visualization</h2>
                    <p class="text-lg">Step into a world where construction projects are not just built but experienced. PlanAR introduces a robust digital framework, allowing stakeholders to delve into accurate and immersive scale models throughout every construction phase. Experience the future of precision visualization.</p>
                </div>

                <!-- Image on the right -->
                <div>
                <img src="{{ asset('storage/images/web.jpg') }}" alt="Image Description" class="w-full h-auto rounded-md">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-8">
             <!-- Image on the right -->
             <div>
             <img src="{{ asset('storage/images/metadata.jpg') }}" alt="Image Description" class="w-full h-auto rounded-md">
                </div>    
            
            <!-- Text on the left -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Adaptive Solutions </h2>
                    <p class="text-lg">In the heart of Malaysia's construction landscape, PlanAR stands as a transformative force. As the adoption of Building Information Modeling (BIM) takes its first steps, PlanAR offers innovative solutions tailored to the evolving needs of the AEC industry. Embrace digital evolution with PlanAR.</p>
                    
                </div>

               
            </div>
        </div>
    </div>
<!-- Feature Section -->
<div class="bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold mb-6">Transformative Impact in Numbers</h2>

            <!-- 2x2 Centered Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
                <!-- Feature 1 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Projects Visualized</h3>
                    <p class="text-gray-600">Over 1000</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Stakeholders Immersed</h3>
                    <p class="text-gray-600"> 5000+</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Enhanced Efficiency</h3>
                    <p class="text-gray-600">40% increase</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Competitiveness Boost</h3>
                    <p class="text-gray-600">Exceeding industry standards</p>
                </div>
            </div>
        </div>
    </div>
  

    <!-- Pricing Section -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <h2 class="text-3xl font-bold mb-6">Choose Your PlanAR Experience</h2>

            <!-- 1x2 Grid List for Pricing -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Pricing Plan 1 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Basic Plan</h3>
                    <p class="text-gray-600">Precision visualization for small projects</p>
                    <p class="text-gray-600">Access to essential features</p>
                    <p class="text-gray-600">Monthly updates and support</p>
                    <p class="text-2xl font-bold mt-4">MYR 99.00/month</p>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md mt-4">Subscribe</button>
                </div>

                <!-- Pricing Plan 2 -->
                <div class="bg-gray-100 p-6 rounded-md">
                    <h3 class="text-xl font-semibold mb-2">Yearly Plan</h3>
                    <p class="text-gray-600">Advanced scale models for medium-sized projects</p>
                    <p class="text-gray-600">Full access to all features</p>
                    <p class="text-gray-600">Priority support and regular feature updates</p>
                    <p class="text-2xl font-bold mt-4">MYR 999.00/month</p>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-md mt-4">Subscribe</button>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 items-center gap-8">
             <!-- Image on the right -->
             <div>
             <img src="{{ asset('storage/images/footer.jpg') }}" alt="Image Description" class="w-full h-auto rounded-md">
                </div>    
            
            <!-- Text on the left -->
                <div>
                    <h2 class="text-3xl font-bold mb-6">Seamless Collaboration Hub</h2>
                    <p class="text-lg">Our seamless collaboration hub transcends geographical boundaries, bringing project stakeholders together in real-time. Foster effective communication, share insights, and streamline decision-making, ensuring your construction projects progress with unparalleled efficiency. PlanAR - where collaboration meets construction excellence.</p>
                    
                </div>

               
            </div>
        </div>
    </div>
    </div>



    <x-footer />
</x-app-layout>
