@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ship Details</h1>
        <div>
            <a href="{{ route('admin.ships.edit', $ship->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
            <a href="{{ route('admin.ships.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 mb-4">
            <img src="{{ $ship->image_url }}" class="img-fluid rounded border" alt="{{ $ship->name }}">
        </div>
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="mb-3">{{ $ship->name }}</h3>
                    <p class="mb-2"><strong>Type:</strong> {{ $ship->type }}</p>
                    <p class="mb-2"><strong>Capacity:</strong> {{ $ship->capacity }} people</p>
                    <p class="mb-2"><strong>Price / day:</strong> {{ format_idr((int) $ship->price_per_day) }}</p>
                    <p class="mb-2"><strong>Location:</strong> {{ $ship->location }}</p>
                    <p class="mb-2"><strong>Status:</strong> {{ ucfirst($ship->status ?? 'available') }}</p>
                    <hr>
                    <h5 class="mb-3">Specifications</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Capacity:</strong> {{ $ship->specifications['capacity'] ?? 'N/A' }}</p>
                            <p class="mb-2"><strong>Length:</strong> {{ $ship->specifications['length'] ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Max Speed:</strong> {{ $ship->specifications['max_speed'] ?? 'N/A' }}</p>
                            <p class="mb-2"><strong>Year Built:</strong> {{ $ship->specifications['year_built'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <hr>
                    <p class="mb-0"><strong>Description</strong></p>
                    <p>{{ $ship->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


