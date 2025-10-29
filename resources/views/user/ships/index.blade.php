@extends('user.layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Explore Our Fleet</h1>

    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar sticky-top" style="top: 20px;">
                <h4 class="mb-3">Filters</h4>
                <form action="{{ route('ships.index') }}" method="GET">
                    <!-- Ship Type Filter -->
                    <div class="mb-4">
                        <h5>Ship Type</h5>
                        @foreach($types as $type)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="type[]" value="{{ $type->name }}" id="type-{{ $type->id }}">
                            <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->name }}</label>
                        </div>
                        @endforeach
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-4">
                        <h5>Price Range</h5>
                        <div class="mb-3">
                            <label for="min-price" class="form-label">Min Price: $<span id="min-price-value">0</span></label>
                            <input type="range" class="form-range" id="min-price" name="min_price" min="0" max="2000" step="50" value="{{ request('min_price', 0) }}"
                                   oninput="document.getElementById('min-price-value').textContent = this.value">
                        </div>
                        <div class="mb-3">
                            <label for="max-price" class="form-label">Max Price: $<span id="max-price-value">2000</span></label>
                            <input type="range" class="form-range" id="max-price" name="max_price" min="0" max="2000" step="50" value="{{ request('max_price', 2000) }}"
                                   oninput="document.getElementById('max-price-value').textContent = this.value">
                        </div>
                    </div>

                    <!-- Capacity Filter -->
                    <div class="mb-4">
                        <h5>Capacity</h5>
                        <select class="form-select" name="capacity">
                            <option value="">Any</option>
                            <option value="1-4" {{ request('capacity')=='1-4'?'selected':'' }}>1-4 People</option>
                            <option value="5-8" {{ request('capacity')=='5-8'?'selected':'' }}>5-8 People</option>
                            <option value="9-12" {{ request('capacity')=='9-12'?'selected':'' }}>9-12 People</option>
                            <option value="13+" {{ request('capacity')=='13+'?'selected':'' }}>13+ People</option>
                        </select>
                    </div>

                    <!-- Amenities Filter -->
                    <div class="mb-4">
                        <h5>Amenities</h5>
                        @php
                            $allAmenities = ['WiFi','Kitchen','Air Conditioning','BBQ','Sound System'];
                        @endphp
                        @foreach($allAmenities as $amenity)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity }}" id="amenity-{{ $amenity }}">
                            <label class="form-check-label" for="amenity-{{ $amenity }}">{{ $amenity }}</label>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('ships.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                </form>
            </div>
        </div>

        <!-- Ships Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0">Showing {{ $ships->count() }} results</p>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort By
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Price: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Capacity: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Capacity: High to Low</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                @foreach($ships as $ship)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card ship-card h-100">
                        <div class="position-relative">
                            <img src="{{ $ship->image }}" class="card-img-top" alt="{{ $ship->name }}">
                            <button class="btn btn-sm wishlist-btn position-absolute top-0 end-0 m-2 text-white" style="background: rgba(0,0,0,0.5);" data-ship-id="{{ $ship->id }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $ship->name }}</h5>
                            <p class="card-text">
                                @foreach($ship->types as $type)
                                    <span class="badge bg-primary">{{ $type->name }}</span>
                                @endforeach
                                <span class="badge bg-secondary">{{ $ship->capacity }} People</span>
                            </p>
                            <p class="card-text fw-bold">${{ $ship->price_per_day }} / day</p>
                            @if($ship->amenities)
                            <p class="card-text small text-muted">
                                Amenities: {{ implode(', ', json_decode($ship->amenities)) }}
                            </p>
                            @endif
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('ships.show', $ship->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $ships->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
