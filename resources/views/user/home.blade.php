@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background-image: url('https://placehold.co/1920x1080?text=Luxury+Yacht+1');">
    <div class="hero-overlay">
        <div class="hero-content container text-center">
            <h1 class="display-4 fw-bold mb-4">Discover the Ultimate Yacht Experience</h1>
            <p class="lead mb-4">Explore the waters in style with our premium yacht and ship rentals</p>
            <a href="{{ route('ships.index') }}" class="btn btn-primary btn-lg">Browse Fleet</a>
        </div>
    </div>
</section>

<!-- Featured Ships Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Ships</h2>
        <div class="row">
            <!-- Ship Card 1 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card ship-card h-100">
                    <img src="https://placehold.co/600x400?text=Luxury+Yacht" class="card-img-top" alt="Luxury Yacht">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="ship-type">Luxury Yacht</span>
                            <span class="ship-price">$1,500/day</span>
                        </div>
                        <h5 class="card-title">Ocean Explorer</h5>
                        <p class="card-text">Experience luxury on the water with this stunning 80-foot yacht featuring 3 cabins, a spacious deck, and state-of-the-art navigation.</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('ships.show', 1) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Ship Card 2 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card ship-card h-100">
                    <img src="https://placehold.co/600x400?text=Catamaran" class="card-img-top" alt="Catamaran">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="ship-type">Catamaran</span>
                            <span class="ship-price">$900/day</span>
                        </div>
                        <h5 class="card-title">Twin Voyager</h5>
                        <p class="card-text">Perfect for family trips, this 50-foot catamaran offers stability, space, and comfort with 4 cabins and a large common area.</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('ships.show', 2) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            
            <!-- Ship Card 3 -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card ship-card h-100">
                    <img src="https://placehold.co/600x400?text=Speedboat" class="card-img-top" alt="Speedboat">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="ship-type">Speedboat</span>
                            <span class="ship-price">$500/day</span>
                        </div>
                        <h5 class="card-title">Wave Runner</h5>
                        <p class="card-text">Feel the thrill of speed with this 30-foot speedboat, perfect for day trips and water sports adventures.</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('ships.show', 3) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('ships.index') }}" class="btn btn-primary">View All Ships</a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose Us</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-ship fa-3x text-primary mb-3"></i>
                        <h4 class="card-title">Premium Fleet</h4>
                        <p class="card-text">Our fleet consists of only the finest, well-maintained vessels to ensure your safety and comfort.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                        <h4 class="card-title">Expert Crew</h4>
                        <p class="card-text">Our professional crew members are highly trained and dedicated to providing exceptional service.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-star fa-3x text-primary mb-3"></i>
                        <h4 class="card-title">Personalized Experience</h4>
                        <p class="card-text">We tailor each rental experience to meet your specific needs and preferences.</p>
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

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4">Ready for Your Next Adventure?</h2>
        <p class="lead mb-4">Book your dream yacht or ship today and set sail for an unforgettable experience</p>
        <a href="{{ route('ships.index') }}" class="btn btn-light btn-lg">Browse Our Fleet</a>
    </div>
</section>
@endsection