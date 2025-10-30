@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Ship</h1>
        <a href="{{ route('admin.ships.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Ships
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.ships.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Ship Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="type" class="form-label">Ship Type</label>
                        <select id="type" name="type" class="form-select @error('type') is-invalid @enderror" required>
                            @php $types = ['Yacht','Speedboat','Catamaran','Pontoon','Fishing Boat','Sailboat']; @endphp
                            <option value="">Select type</option>
                            @foreach($types as $t)
                                <option value="{{ $t }}" {{ old('type')===$t ? 'selected' : '' }}>{{ $t }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                            id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" required>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label for="price_per_day" class="form-label">Price Per Day ($)</label>
                        <input type="number" step="0.01" class="form-control @error('price_per_day') is-invalid @enderror" 
                            id="price_per_day" name="price_per_day" value="{{ old('price_per_day') }}" min="0" required>
                        @error('price_per_day')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                        id="location" name="location" value="{{ old('location') }}" required>
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Ship Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="features" class="form-label">Amenities (comma separated)</label>
                    <input type="text" class="form-control @error('features') is-invalid @enderror" id="features" name="features" value="{{ old('features') }}" placeholder="WiFi, Kitchen, Air Conditioning">
                    @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Specifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="specifications[capacity]" class="form-label">Capacity</label>
                                <input type="text" class="form-control" name="specifications[capacity]" id="specifications[capacity]" 
                                    value="{{ old('specifications.capacity') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="specifications[length]" class="form-label">Length</label>
                                <input type="text" class="form-control" name="specifications[length]" id="specifications[length]"
                                    value="{{ old('specifications.length') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="specifications[max_speed]" class="form-label">Max Speed</label>
                                <input type="text" class="form-control" name="specifications[max_speed]" id="specifications[max_speed]"
                                    value="{{ old('specifications.max_speed') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="specifications[year_built]" class="form-label">Year Built</label>
                                <input type="text" class="form-control" name="specifications[year_built]" id="specifications[year_built]"
                                    value="{{ old('specifications.year_built') }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                        id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Ship
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection