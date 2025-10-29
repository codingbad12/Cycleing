@extends('user.layouts.app')

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
            @forelse($ships as $ship)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card ship-card h-100">
                        <img src="{{ $ship->image ? asset('storage/' . $ship->image) : 'https://placehold.co/600x400?text=No+Image' }}" class="card-img-top" alt="{{ $ship->name }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="ship-type">
                                    @foreach($ship->types as $type)
                                        {{ $type->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </span>
                                <span class="ship-price">${{ number_format($ship->price_per_day, 0, ',', ',') }}/day</span>
                            </div>
                            <h5 class="card-title">{{ $ship->name }}</h5>
                            <p class="card-text">{{ Str::limit($ship->description, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('ships.show', $ship->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No ships available at the moment.</p>
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
            @foreach($reviews as $review)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($review->rating))
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i - $review->rating < 1)
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="card-text">{{ $review->comment }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex align-items-center">
                                <img src="{{ $review->user->avatar ?? 'https://placehold.co/50x50' }}" class="rounded-circle me-3" alt="Customer">
                                <div>
                                    <h6 class="mb-0">{{ $review->user->name }}</h6>
                                    <small class="text-muted">{{ $review->ship->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
