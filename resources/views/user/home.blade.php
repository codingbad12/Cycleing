@extends('layouts.app')

@section('content')
<!-- Hero Section -->
@if(!empty($slideshowImages) && count($slideshowImages) > 0)
<div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($slideshowImages as $idx => $img)
            <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx==0 ? 'active' : '' }}" aria-current="{{ $idx==0 ? 'true' : 'false' }}" aria-label="Slide {{ $idx+1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($slideshowImages as $idx => $img)
        <div class="carousel-item {{ $idx==0 ? 'active' : '' }}" style="height: 500px;">
            <img src="{{ $img }}" class="d-block w-100" alt="Slide {{ $idx+1 }}" style="object-fit: cover; height: 500px;">
            <div class="carousel-caption d-none d-md-block">
                <h3>Explore Our Fleet</h3>
                <p>Premium ships and yachts available for your next adventure</p>
                <a href="{{ route('ships.index') }}" class="btn btn-primary">Browse Fleet</a>
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@else
<section class="hero-section" style="background-image: url('{{ asset('images/home/hero-yacht.jpg') }}');">
    <div class="hero-overlay">
        <div class="hero-content container text-center">
            <h1 class="display-4 fw-bold mb-4">Discover the Ultimate Yacht Experience</h1>
            <p class="lead mb-4">Explore the waters in style with our premium yacht and ship rentals</p>
            <a href="{{ route('ships.index') }}" class="btn btn-primary btn-lg">Browse Fleet</a>
        </div>
    </div>
</section>
@endif

<!-- Featured Ships Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Ships</h2>
        <div class="row">
            @forelse($featuredShips as $ship)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card ship-card h-100">
                        @if($ship->image)
                            <img src="{{ asset('storage/' . $ship->image) }}" class="card-img-top" alt="{{ $ship->name }}">
                        @else
                            <img src="https://placehold.co/600x400?text=Ship" class="card-img-top" alt="{{ $ship->name }}">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="ship-type">{{ $ship->type }}</span>
                                <span class="ship-price">{{ format_idr((int) $ship->price_per_day) }} / day</span>
                            </div>
                            <h5 class="card-title">{{ $ship->name }}</h5>
                            @if(!empty($ship->description))
                                <p class="card-text">{{ $ship->description }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('ships.show', $ship->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">No ships available yet. Please check back later.</div>
                </div>
            @endforelse
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