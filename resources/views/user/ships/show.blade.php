@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ships.index') }}">Ships</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $ship->name }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- Ship Images -->
        <div class="col-lg-8 mb-4">
            <div id="shipCarousel" class="carousel slide" data-bs-ride="carousel">
                @php
                    $slides = [];
                    if(!empty($ship->images) && is_array($ship->images) && count($ship->images) > 0) {
                        foreach($ship->images as $img) {
                            $slides[] = asset('storage/' . $img);
                        }
                    } elseif($ship->image) {
                        $slides[] = asset('storage/' . $ship->image);
                    }
                @endphp

                @if(count($slides) > 1)
                <div class="carousel-indicators">
                    @foreach($slides as $idx => $s)
                        <button type="button" data-bs-target="#shipCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx==0 ? 'active' : '' }}" aria-current="{{ $idx==0 ? 'true' : 'false' }}" aria-label="Slide {{ $idx+1 }}"></button>
                    @endforeach
                </div>
                @endif

                <div class="carousel-inner rounded">
                    @if(count($slides) > 0)
                        @foreach($slides as $idx => $s)
                            <div class="carousel-item {{ $idx==0 ? 'active' : '' }}">
                                <img src="{{ $s }}" class="d-block w-100" alt="{{ $ship->name }}" style="height: 500px; object-fit: cover;">
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item active">
                            <img src="https://placehold.co/800x500?text=Ship" class="d-block w-100" alt="{{ $ship->name }}" style="height: 500px; object-fit: cover;">
                        </div>
                    @endif
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
                <h1 class="mb-3">{{ $ship->name }}</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary me-2">{{ $ship->type }}</span>
                    <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> {{ $ship->location }}</span>
                    <div class="ms-auto">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-share-alt me-1"></i> Share
                        </button>
                    </div>
                </div>
                
                <h4 class="mb-3">Description</h4>
                <p>{{ $ship->description ?? 'No description available.' }}</p>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h4 class="mb-3">Specifications</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-users me-2"></i> Capacity</span>
                                <span class="badge bg-primary rounded-pill">{{ $ship->specifications['capacity'] ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-ruler me-2"></i> Length</span>
                                <span>{{ $ship->specifications['length'] ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-tachometer-alt me-2"></i> Max Speed</span>
                                <span>{{ $ship->specifications['max_speed'] ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-calendar-alt me-2"></i> Year Built</span>
                                <span>{{ $ship->specifications['year_built'] ?? 'N/A' }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-3">Amenities</h4>
                        <div class="row">
                            @foreach(($ship->features ?? []) as $amenity)
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
                        <h4 class="mb-0">{{ format_idr((int) $ship->price_per_day) }} <small class="text-muted">/ day</small></h4>
                </div>
                <div class="card-body">
                    <!-- Booking Restrictions Warning -->
                    <div class="alert alert-info mb-3">
                        <h5 class="alert-heading"><i class="fas fa-info-circle"></i> Booking Restrictions</h5>
                        <ul class="mb-0">
                            <li>Maximum booking duration is 5 days</li>
                            <li>Maximum 2 bookings per ship category ({{ $ship->type }})</li>
                        </ul>
                    </div>
                    
                    <form action="{{ route('ships.book', $ship->id) }}" method="POST" id="bookingForm">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        @error('category_limit')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        
                        @if (session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="start_date" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Number of Guests</label>
                            <select class="form-select" id="guests" name="guests" required>
                                @for($i = 1; $i <= $ship->capacity; $i++)
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
<span>{{ format_idr((int) ($ship->price_per_day * 3)) }}</span>
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
<span>{{ format_idr((int) ($ship->price_per_day * 3 + 600 + 150)) }}</span>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">Book Now</button>
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
            @forelse($similarShips as $similarShip)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card ship-card h-100">
                    @if($similarShip->image)
                        <img src="{{ asset('storage/' . $similarShip->image) }}" class="card-img-top" alt="{{ $similarShip->name }}">
                    @else
                        <img src="https://placehold.co/600x400?text=Ship" class="card-img-top" alt="{{ $similarShip->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $similarShip->name }}</h5>
                        <p class="card-text">
                            <span class="badge bg-primary">{{ $similarShip->type }}</span>
                            <span class="badge bg-secondary">{{ $similarShip->capacity }} People</span>
                        </p>
                        <p class="card-text fw-bold">{{ format_idr((int) $similarShip->price_per_day) }} / day</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('ships.show', $similarShip->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No similar ships available at the moment.</div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection