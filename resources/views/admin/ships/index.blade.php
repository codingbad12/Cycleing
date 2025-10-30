@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Ship Management</h1>
        <a href="{{ route('admin.ships.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Ship
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Ships</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Price/Day</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ships as $ship)
                        <tr>
                            <td>{{ $ship->id }}</td>
                            <td>
                                @if($ship->image)
                                    <img src="{{ asset('storage/' . $ship->image) }}" alt="{{ $ship->name }}" width="100" class="img-thumbnail">
                                @else
                                    <img src="https://placehold.co/100x60?text=Ship" alt="{{ $ship->name }}" width="100" class="img-thumbnail">
                                @endif
                            </td>
                            <td>{{ $ship->name }}</td>
                            <td>{{ $ship->type }}</td>
                            <td>{{ $ship->capacity }} people</td>
                            <td>${{ number_format($ship->price_per_day, 2) }}</td>
                            <td>{{ $ship->location }}</td>
                            <td>
                                @if($ship->status == 'available')
                                    <span class="badge bg-success">Available</span>
                                @elseif($ship->status == 'rented')
                                    <span class="badge bg-warning">Rented</span>
                                @else
                                    <span class="badge bg-secondary">Maintenance</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.ships.show', $ship->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.ships.edit', $ship->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.ships.destroy', $ship->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this ship?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No ships found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $ships->links() }}
            </div>
        </div>
    </div>
</div>
@endsection