@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Booking Details</h1>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Bookings
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Booking #{{ $booking->id }}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Ship Information</h5>
                            <p><strong>Name:</strong> {{ $booking->ship->name ?? 'Unknown' }}</p>
                            <p><strong>Type:</strong> {{ $booking->ship->type ?? 'Unknown' }}</p>
                            <p><strong>Capacity:</strong> {{ $booking->ship->capacity ?? 'Unknown' }} people</p>
                            <p><strong>Location:</strong> {{ $booking->ship->location ?? 'Unknown' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Booking Details</h5>
                            <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
                            <p><strong>Guests:</strong> {{ $booking->guests }}</p>
                            <p><strong>Status:</strong> 
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @elseif($booking->status == 'return_requested')
                                    <span class="badge bg-info">Return Requested</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge bg-primary">Completed</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>User Information</h5>
                            <p><strong>Name:</strong> {{ $booking->user->name ?? 'Unknown' }}</p>
                            <p><strong>Email:</strong> {{ $booking->user->email ?? 'Unknown' }}</p>
                            <p><strong>Phone:</strong> {{ $booking->user->phone ?? 'Not provided' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Financial Details</h5>
                            <p><strong>Price per Day:</strong> ${{ number_format($booking->ship->price_per_day ?? 0, 2) }}</p>
                            <p><strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}</p>
                            @if($booking->late_fee)
                                <p><strong>Late Fee:</strong> ${{ number_format($booking->late_fee, 2) }}</p>
                                <p><strong>Grand Total:</strong> ${{ number_format($booking->total_price + $booking->late_fee, 2) }}</p>
                            @endif
                        </div>
                    </div>

                    @if($booking->special_requests)
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Special Requests</h5>
                            <p>{{ $booking->special_requests }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <h5>Actions</h5>
                            <div class="btn-group" role="group">
                                @if($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Approve Booking
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline ms-2">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times"></i> Reject Booking
                                        </button>
                                    </form>
                                @endif
                                
                                @if($booking->status == 'return_requested')
                                    <form action="{{ route('admin.bookings.return', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Confirm Return
                                        </button>
                                    </form>
                                @endif
                                
                                @if($booking->status == 'completed')
                                    <a href="{{ route('admin.reports.invoice', $booking->id) }}" class="btn btn-primary">
                                        <i class="fas fa-file-invoice"></i> View Invoice
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ship Image</h6>
                </div>
                <div class="card-body">
                    <img src="{{ $booking->ship->image_url }}" 
                         alt="{{ $booking->ship->name ?? 'Ship' }}" class="img-fluid rounded">
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rental Timeline</h6>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Booking Created</h6>
                                <p class="timeline-date">{{ $booking->created_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                        
                        @if($booking->status != 'pending')
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">
                                    @if($booking->status == 'rejected')
                                        Booking Rejected
                                    @else
                                        Booking Approved
                                    @endif
                                </h6>
                                <p class="timeline-date">{{ $booking->updated_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                        @endif
                        
                        @if($booking->status == 'return_requested' || $booking->status == 'completed')
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Return Requested</h6>
                                <p class="timeline-date">{{ $booking->updated_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                        @endif
                        
                        @if($booking->status == 'completed')
                        <li class="timeline-item">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Return Confirmed</h6>
                                <p class="timeline-date">{{ $booking->actual_return_date ?? $booking->updated_at->format('M d, Y') }}</p>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding-left: 1.5rem;
        list-style: none;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    .timeline-marker {
        position: absolute;
        left: -1.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        background-color: #4e73df;
    }
    .timeline-content {
        padding-left: 0.5rem;
    }
    .timeline-title {
        margin-bottom: 0.25rem;
    }
    .timeline-date {
        color: #6c757d;
        font-size: 0.85rem;
    }
</style>
@endsection