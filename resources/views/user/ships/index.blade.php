@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Explore Our Fleet</h1>
    
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar sticky-top" style="top: 20px;">
                <h4 class="mb-3">Filters</h4>
                <div id="active-filters" class="mb-3">
                    @if(isset($activeFilters) && count($activeFilters) > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($activeFilters as $key => $value)
                                @if($key === 'search')
                                    <span class="badge bg-primary">Search: {{ $value }} <i class="fas fa-times"></i></span>
                                @elseif($key === 'types')
                                    @foreach($value as $type)
                                        <span class="badge bg-primary">Type: {{ $type }} <i class="fas fa-times"></i></span>
                                    @endforeach
                                @elseif($key === 'amenities')
                                    @foreach($value as $amenity)
                                        <span class="badge bg-primary">Amenity: {{ $amenity }} <i class="fas fa-times"></i></span>
                                    @endforeach
                                @elseif($key === 'price_range')
                                    <span class="badge bg-primary">Price: ${{ $value['min'] }} - ${{ $value['max'] }} <i class="fas fa-times"></i></span>
                                @elseif($key === 'min_capacity')
                                    <span class="badge bg-primary">Min Capacity: {{ $value }} <i class="fas fa-times"></i></span>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small">No filters applied</p>
                    @endif
                </div>
                <form action="{{ route('ships.index') }}" method="GET" id="filter-form">
                    <!-- Ship Type Filter -->
                    <div class="mb-4">
                        <h5>Ship Type</h5>
                        @foreach($shipTypes ?? ['Yacht', 'Speedboat', 'Sailboat', 'Pontoon', 'Fishing Boat', 'Catamaran'] as $type)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" 
                                id="{{ strtolower(str_replace(' ', '-', $type)) }}" 
                                name="type[]" 
                                value="{{ $type }}"
                                {{ isset($activeFilters['types']) && in_array($type, $activeFilters['types']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ strtolower(str_replace(' ', '-', $type)) }}">{{ $type }}</label>
                        </div>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="catamaran" name="type[]" value="Catamaran">
                            <label class="form-check-label" for="catamaran">Catamaran</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pontoon" name="type[]" value="Pontoon">
                            <label class="form-check-label" for="pontoon">Pontoon</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="fishing" name="type[]" value="Fishing Boat">
                            <label class="form-check-label" for="fishing">Fishing Boat</label>
                        </div>
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="mb-4">
                        <h5>Price Range</h5>
                        <div class="mb-3">
                            <label for="min-price" class="form-label">Min Price: $<span id="min-price-value">0</span></label>
                            <input type="range" class="form-range" id="min-price" name="min_price" min="0" max="2000" step="50" value="0" oninput="document.getElementById('min-price-value').textContent = this.value">
                        </div>
                        <div class="mb-3">
                            <label for="max-price" class="form-label">Max Price: $<span id="max-price-value">2000</span></label>
                            <input type="range" class="form-range" id="max-price" name="max_price" min="0" max="2000" step="50" value="2000" oninput="document.getElementById('max-price-value').textContent = this.value">
                        </div>
                    </div>
                    
                    <!-- Capacity Filter -->
                    <div class="mb-4">
                        <h5>Capacity</h5>
                        <select class="form-select" name="capacity">
                            <option value="">Any</option>
                            <option value="1-4">1-4 People</option>
                            <option value="5-8">5-8 People</option>
                            <option value="9-12">9-12 People</option>
                            <option value="13+">13+ People</option>
                        </select>
                    </div>
                    
                    <!-- Amenities Filter -->
                    <div class="mb-4">
                        <h5>Amenities</h5>
                        @foreach($allAmenities ?? ['WiFi', 'Kitchen', 'Air Conditioning', 'BBQ', 'Sound System', 'Fishing Gear', 'Navigation System', 'Cooler', 'Sleeping Quarters', 'Canopy'] as $amenity)
                        <div class="form-check">
                            <input class="form-check-input filter-checkbox" type="checkbox" 
                                id="{{ strtolower(str_replace(' ', '-', $amenity)) }}" 
                                name="amenities[]" 
                                value="{{ $amenity }}"
                                {{ isset($activeFilters['amenities']) && in_array($amenity, $activeFilters['amenities']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ strtolower(str_replace(' ', '-', $amenity)) }}">{{ $amenity }}</label>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Price Range Filter -->
                    <div class="mb-4">
                        <h5>Price Range</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="min_price" class="form-label">Min ($)</label>
                                    <input type="number" class="form-control" id="min_price" name="min_price" 
                                        min="0" max="2000" step="50" 
                                        value="{{ $activeFilters['price_range']['min'] ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="max_price" class="form-label">Max ($)</label>
                                    <input type="number" class="form-control" id="max_price" name="max_price" 
                                        min="0" max="2000" step="50" 
                                        value="{{ $activeFilters['price_range']['max'] ?? 2000 }}">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div id="price-range-slider"></div>
                        </div>
                    </div>
                    
                    <!-- Capacity Filter -->
                    <div class="mb-4">
                        <h5>Capacity</h5>
                        <div class="form-group">
                            <label for="min_capacity" class="form-label">Minimum Guests</label>
                            <select class="form-select" id="min_capacity" name="min_capacity">
                                <option value="">Any</option>
                                @for($i = 2; $i <= 15; $i += 2)
                                    <option value="{{ $i }}" {{ (isset($activeFilters['min_capacity']) && $activeFilters['min_capacity'] == $i) ? 'selected' : '' }}>
                                        {{ $i }}+ guests
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('ships.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                </form>
            </div>
        </div>
        
        <!-- Ships Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0">Showing {{ count($ships) }} results</p>
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
                @forelse($ships as $ship)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card ship-card h-100">
                        <div class="position-relative">
                            @if($ship->image)
                                <img src="{{ asset('storage/' . $ship->image) }}" class="card-img-top" alt="{{ $ship->name }}">
                            @else
                                <img src="https://placehold.co/600x400?text=Ship" class="card-img-top" alt="{{ $ship->name }}">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $ship->name }}</h5>
                            <p class="card-text">
                                <span class="badge bg-primary">{{ $ship->type }}</span>
                                <span class="badge bg-secondary">{{ $ship->capacity }} People</span>
                            </p>
                            <p class="card-text fw-bold">{{ format_idr((int) $ship->price_per_day) }} / day</p>
                            <p class="card-text small text-muted">
                                <i class="fas fa-map-marker-alt me-1"></i> Jakarta & Pulau Seribu
                            </p>
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
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection