<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cycleing - Boat Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo and Website Name -->
            <div class="flex items-center space-x-2">
                <img src="/images/logo.png" alt="Cycleing Logo" class="h-10 w-10">
                <span class="text-2xl font-bold text-blue-600">Cycleing</span>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-600">Contact</a>
            </div>
            
            <!-- Sign In/Sign Up Buttons -->
            <div class="flex space-x-2">
                <a href="#" class="px-4 py-2 text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Sign In</a>
                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Sign Up</a>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section with Slideshow -->
    <div class="relative h-96 bg-blue-100">
        <!-- Slideshow container -->
        <div class="slideshow-container h-full">
            <!-- Slides -->
            <div class="slide fade h-full">
                <img src="/images/boat1.jpg" class="w-full h-full object-cover" alt="Luxury Boat">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="text-4xl font-bold mb-4">Jakarta & Pulau Seribu</h1>
                        <p class="text-xl mb-6">Explore the beautiful waters with our premium boat rentals</p>
                        <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Book Now</a>
                    </div>
                </div>
            </div>
            
            <div class="slide fade h-full hidden">
                <img src="/images/boat2.jpg" class="w-full h-full object-cover" alt="Speed Boat">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="text-4xl font-bold mb-4">Premium Fleet</h1>
                        <p class="text-xl mb-6">Choose from our wide selection of boats for your adventure</p>
                        <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">View Fleet</a>
                    </div>
                </div>
            </div>
            
            <div class="slide fade h-full hidden">
                <img src="/images/boat3.jpg" class="w-full h-full object-cover" alt="Yacht">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <div class="text-center text-white px-4">
                        <h1 class="text-4xl font-bold mb-4">Unforgettable Experience</h1>
                        <p class="text-xl mb-6">Create memories that last a lifetime</p>
                        <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Learn More</a>
                    </div>
                </div>
            </div>
            
            <!-- Navigation arrows -->
            <a class="prev absolute top-1/2 left-4 -translate-y-1/2 cursor-pointer z-10 text-white text-4xl" onclick="changeSlide(-1)">&#10094;</a>
            <a class="next absolute top-1/2 right-4 -translate-y-1/2 cursor-pointer z-10 text-white text-4xl" onclick="changeSlide(1)">&#10095;</a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Filter Sidebar -->
            <div class="w-full md:w-1/4 bg-white p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4">Filter</h2>
                
                <!-- Price Range -->
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Price</h3>
                    <div class="space-y-2">
                        <div>
                            <input type="checkbox" id="price1" class="mr-2">
                            <label for="price1">$0 - $500</label>
                        </div>
                        <div>
                            <input type="checkbox" id="price2" class="mr-2">
                            <label for="price2">$500 - $1000</label>
                        </div>
                        <div>
                            <input type="checkbox" id="price3" class="mr-2">
                            <label for="price3">$1000+</label>
                        </div>
                    </div>
                </div>
                
                <!-- Type -->
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Type</h3>
                    <div class="space-y-2">
                        <div>
                            <input type="checkbox" id="type1" class="mr-2">
                            <label for="type1">Luxury Yacht</label>
                        </div>
                        <div>
                            <input type="checkbox" id="type2" class="mr-2">
                            <label for="type2">Speed Boat</label>
                        </div>
                        <div>
                            <input type="checkbox" id="type3" class="mr-2">
                            <label for="type3">Fishing Boat</label>
                        </div>
                        <div>
                            <input type="checkbox" id="type4" class="mr-2">
                            <label for="type4">Sailboat</label>
                        </div>
                    </div>
                </div>
                
                <!-- Capacity -->
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Capacity</h3>
                    <div class="space-y-2">
                        <div>
                            <input type="checkbox" id="cap1" class="mr-2">
                            <label for="cap1">1-5 People</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cap2" class="mr-2">
                            <label for="cap2">6-10 People</label>
                        </div>
                        <div>
                            <input type="checkbox" id="cap3" class="mr-2">
                            <label for="cap3">11+ People</label>
                        </div>
                    </div>
                </div>
                
                <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Apply Filters</button>
            </div>
            
            <!-- Boat Listings -->
            <div class="w-full md:w-3/4">
                <h2 class="text-2xl font-bold mb-6">Available Boats</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Boat Card 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat1.jpg" alt="Luxury Yacht" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Luxury Yacht</h3>
                            <p class="text-gray-600 mb-4">Experience luxury on water with our premium yacht. Perfect for special occasions.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$1200/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boat Card 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat2.jpg" alt="Speed Boat" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Speed Boat</h3>
                            <p class="text-gray-600 mb-4">Feel the thrill with our high-speed boat. Great for water sports and adventures.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$800/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boat Card 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat3.jpg" alt="Fishing Boat" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Fishing Boat</h3>
                            <p class="text-gray-600 mb-4">Fully equipped fishing boat for the perfect fishing trip with friends and family.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$600/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boat Card 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat4.jpg" alt="Sailboat" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Sailboat</h3>
                            <p class="text-gray-600 mb-4">Experience the traditional way of sailing with our beautiful sailboat.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$500/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boat Card 5 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat5.jpg" alt="Party Boat" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Party Boat</h3>
                            <p class="text-gray-600 mb-4">Perfect for hosting parties and events on water with spacious deck.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$1500/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Boat Card 6 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <img src="/images/boat6.jpg" alt="Family Boat" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">Family Boat</h3>
                            <p class="text-gray-600 mb-4">Comfortable and safe boat ideal for family outings and relaxed cruising.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-blue-600 font-bold">$700/day</span>
                                <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Cycleing Boat Rentals</h3>
                    <p>Providing premium boat rental services for all your water adventures.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-400">Home</a></li>
                        <li><a href="#" class="hover:text-blue-400">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400">Boats</a></li>
                        <li><a href="#" class="hover:text-blue-400">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                    <p>123 Marina Bay, Jakarta</p>
                    <p>Phone: (123) 456-7890</p>
                    <p>Email: info@cycleing.com</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p>&copy; 2023 Cycleing Boat Rentals. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- JavaScript for Slideshow -->
    <script>
        let slideIndex = 0;
        showSlides();
        
        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.add("hidden");
            }
            
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            
            slides[slideIndex-1].classList.remove("hidden");
            setTimeout(showSlides, 5000); // Change slide every 5 seconds
        }
        
        function changeSlide(n) {
            showSlidesByIndex(slideIndex += n);
        }
        
        function showSlidesByIndex(n) {
            let slides = document.getElementsByClassName("slide");
            
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            
            for (let i = 0; i < slides.length; i++) {
                slides[i].classList.add("hidden");
            }
            
            slides[slideIndex-1].classList.remove("hidden");
        }
    </script>
</body>
</html>