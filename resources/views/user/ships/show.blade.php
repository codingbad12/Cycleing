@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ships.index') }}">Ships</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $ship['name'] }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Ship Images -->
        <div class="col-lg-8 mb-4">
            <div id="shipCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#shipCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#shipCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#shipCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img src="{{ $ship['image'] }}" class="d-block w-100" alt="{{ $ship['name'] }}" style="height: 500px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://placehold.co/800x500?text=Interior" class="d-block w-100" alt="Interior" style="height: 500px; object-fit: cover;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://placehold.co/800x500?text=Deck" class="d-block w-100" alt="Deck" style="height: 500px; object-fit: cover;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#shipCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#shipCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            
            <!-- Ship Details -->
            <div class="mt-4">
                <h1 class="mb-3">{{ $ship['name'] }}</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary me-2">{{ $ship['type'] }}</span>
                    <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> Jakarta & Pulau Seribu</span>
                    <div class="ms-auto">
                        <button class="btn btn-outline-danger">
                            <i class="far fa-heart me-1"></i> Add to Wishlist
                        </button>
                        <button class="btn btn-outline-primary ms-2">
                            <i class="fas fa-share-alt me-1"></i> Share
                        </button>
                    </div>
                </div>
                
                <h4 class="mb-3">Description</h4>
                <p>{{ $ship['description'] }}</p>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4 class="mb-3">Specifications</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-users me-2"></i> Capacity</span>
                                <span class="badge bg-primary rounded-pill">{{ $ship['capacity'] }} People</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-ruler me-2"></i> Length</span>
                                <span>42 feet</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-tachometer-alt me-2"></i> Max Speed</span>
                                <span>25 knots</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-calendar-alt me-2"></i> Year Built</span>
                                <span>2020</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-3">Amenities</h4>
                        <div class="row">
                            @foreach($ship['amenities'] as $amenity)
                            <div class="col-6 mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i> {{ $amenity }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Booking Form -->
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-white">
                    <h4 class="mb-0">${{ $ship['price_per_day'] }} <small class="text-muted">/ day</small></h4>
                </div>
                <div class="card-body">
                    <form action="#" method="POST" id="bookingForm">
                        @csrf
                        <div class="mb-3">
                            <label for="start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of Guests</label>
                            <select class="form-select" id="guests" name="guests" required>
                                @for($i = 1; $i <= $ship['capacity']; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="captain" class="form-label">Captain Option</label>
                            <select class="form-select" id="captain" name="captain" required>
                                <option value="with-captain">With Captain (+$200/day)</option>
                                <option value="no-captain">Without Captain</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="specialRequests" class="form-label">Special Requests</label>
                            <textarea class="form-control" id="specialRequests" name="special_requests" rows="2"></textarea>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Base Rate (3 days)</span>
                            <span>${{ $ship['price_per_day'] * 3 }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Captain Fee</span>
                            <span>$600</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Service Fee</span>
                            <span>$150</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 fw-bold">
                            <span>Total</span>
                            <span>${{ $ship['price_per_day'] * 3 + 600 + 150 }}</span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">Book Now</button>
                        <button type="button" class="btn btn-outline-secondary w-100 mt-2 wishlist-btn" data-ship-id="{{ $ship['id'] }}">
                            <i class="far fa-heart"></i> Add to Wishlist
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-white text-center">
                    <small class="text-muted">You won't be charged yet</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reviews Section -->
    <div class="mt-5">
        <h3 class="mb-4">Reviews</h3>
        <div class="row">
            <div class="col-lg-8">
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img src="https://placehold.co/64x64" class="rounded-circle" alt="User" width="64" height="64">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">John Smith</h5>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <span class="ms-2 text-muted">June 15, 2023</span>
                        </div>
                        <p>Amazing experience! The yacht was in perfect condition and exactly as described. The captain was professional and knowledgeable about the area. Would definitely recommend!</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img src="https://placehold.co/64x64" class="rounded-circle" alt="User" width="64" height="64">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">Sarah Johnson</h5>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <span class="ms-2 text-muted">May 28, 2023</span>
                        </div>
                        <p>We had a wonderful day on this yacht. The amenities were great and everything worked perfectly. The only reason for 4 stars instead of 5 is that we had a slight delay at the start. Otherwise, it was perfect!</p>
                    </div>
                </div>
                
                <div class="d-flex mb-4">
                    <div class="flex-shrink-0">
                        <img src="https://placehold.co/64x64" class="rounded-circle" alt="User" width="64" height="64">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="mt-0">Michael Chen</h5>
                        <div class="mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <span class="ms-2 text-muted">April 10, 2023</span>
                        </div>
                        <p>Fantastic yacht and service! We celebrated my wife's birthday on board and it was an unforgettable experience. The crew was attentive and made sure we had everything we needed. Highly recommend!</p>
                    </div>
                </div>
                
                <a href="#" class="btn btn-outline-primary">View All Reviews</a>
            </div>
        </div>
    </div>
    
    <!-- Similar Ships -->
    <div class="mt-5">
        <h3 class="mb-4">You May Also Like</h3>
        <div class="row">
            @php
                $similarShips = [
                    [
                        'id' => 1,
                        'name' => 'Speed Demon',
                        'type' => 'Speed Boat',
                        'price_per_day' => 350,
                        'capacity' => 6,
                        'image' => 'https://placehold.co/600x400?text=Speed+Boat'
                    ],
                    [
                        'id' => 2,
                        'name' => 'Wind Chaser',
                        'type' => 'Sailboat',
                        'price_per_day' => 400,
                        'capacity' => 8,
                        'image' => 'https://placehold.co/600x400?text=Sailboat'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Ocean Explorer',
                        'type' => 'Catamaran',
                        'price_per_day' => 650,
                        'capacity' => 12,
                        'image' => 'https://placehold.co/600x400?text=Catamaran'
                    ]
                ];
            @endphp
            
            @foreach($similarShips as $similarShip)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card ship-card h-100">
                    <img src="{{ $similarShip['image'] }}" class="card-img-top" alt="{{ $similarShip['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $similarShip['name'] }}</h5>
                        <p class="card-text">
                            <span class="badge bg-primary">{{ $similarShip['type'] }}</span>
                            <span class="badge bg-secondary">{{ $similarShip['capacity'] }} People</span>
                        </p>
                        <p class="card-text fw-bold">${{ $similarShip['price_per_day'] }} / day</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('ships.show', $similarShip['id']) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection