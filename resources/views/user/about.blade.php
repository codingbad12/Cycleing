@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background-image: url('https://placehold.co/1920x600?text=About+Us');">
    <div class="hero-overlay">
        <div class="hero-content container">
            <h1 class="display-4 fw-bold mb-4">About SeaVoyage</h1>
            <p class="lead mb-4">Your premier destination for yacht and ship rentals</p>
        </div>
    </div>
</section>

<!-- About Us Content -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://placehold.co/600x400?text=Our+Story" alt="Our Story" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Our Story</h2>
                <p>Founded in 2015, SeaVoyage began with a simple mission: to make the luxury of yacht experiences accessible to everyone. What started as a small fleet of three vessels has now grown into Jakarta's premier yacht and ship rental service.</p>
                <p>Our founder, Captain Budi Santoso, combined his passion for sailing with his entrepreneurial spirit to create a service that offers unforgettable maritime experiences while maintaining the highest standards of safety and comfort.</p>
                <p>Today, SeaVoyage continues to expand its fleet and services, always staying true to our core values of excellence, safety, and customer satisfaction.</p>
            </div>
        </div>
        
        <div class="row align-items-center mb-5 flex-lg-row-reverse">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://placehold.co/600x400?text=Our+Mission" alt="Our Mission" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2 class="mb-4">Our Mission</h2>
                <p>At SeaVoyage, our mission is to provide exceptional maritime experiences that create lasting memories for our customers. We strive to:</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Maintain a diverse fleet of well-maintained vessels to suit every need and budget</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Ensure the highest standards of safety and comfort for all our customers</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Provide personalized service that exceeds expectations</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Promote responsible and sustainable enjoyment of Indonesia's beautiful waters</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://placehold.co/300x300?text=Captain" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">Captain Budi Santoso</h5>
                        <p class="text-muted">Founder & CEO</p>
                        <p class="card-text">With over 20 years of sailing experience, Captain Budi ensures that every vessel in our fleet meets the highest standards of quality and safety.</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://placehold.co/300x300?text=Operations" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">Siti Rahayu</h5>
                        <p class="text-muted">Operations Manager</p>
                        <p class="card-text">Siti oversees all operational aspects of our business, ensuring that every rental experience runs smoothly from booking to return.</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://placehold.co/300x300?text=Customer" class="card-img-top" alt="Team Member">
                    <div class="card-body text-center">
                        <h5 class="card-title">Andi Wijaya</h5>
                        <p class="text-muted">Customer Experience Director</p>
                        <p class="card-text">Andi leads our customer service team, dedicated to providing exceptional experiences and addressing any needs our clients may have.</p>
                        <div class="social-icons mt-3">
                            <a href="#" class="text-primary me-2"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">What Our Customers Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"An unforgettable experience! The yacht was immaculate and the crew was incredibly professional. Will definitely book again!"</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/50x50" class="rounded-circle me-3" alt="Customer">
                            <div>
                                <h6 class="mb-0">John Smith</h6>
                                <small class="text-muted">Luxury Yacht Charter</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Perfect family vacation! The catamaran was spacious and comfortable. The kids loved the water activities and we enjoyed the peaceful sailing."</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/50x50" class="rounded-circle me-3" alt="Customer">
                            <div>
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">Catamaran Rental</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                        </div>
                        <p class="card-text">"The speedboat rental was the highlight of our trip! Fast, exciting, and the perfect way to explore the coastline. Highly recommended!"</p>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex align-items-center">
                            <img src="https://placehold.co/50x50" class="rounded-circle me-3" alt="Customer">
                            <div>
                                <h6 class="mb-0">Michael Chen</h6>
                                <small class="text-muted">Speedboat Adventure</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Get In Touch</h2>
                <p class="lead mb-5">Have questions or ready to book your next adventure? Contact us today!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                        <h5>Visit Us</h5>
                        <p>123 Marina Bay<br>Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                        <h5>Call Us</h5>
                        <p>+62 123 456 7890<br>+62 098 765 4321</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                        <h5>Email Us</h5>
                        <p>info@seavoyage.com<br>bookings@seavoyage.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection