@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Booking Details</h2>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">Back to My Bookings</a>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Booking #{{ $booking->id }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Ship Details</h5>
                    <p><strong>Name:</strong> {{ $booking->ship->name }}</p>
                    <p><strong>Type:</strong> {{ $booking->ship->type }}</p>
                    <p><strong>Capacity:</strong> {{ $booking->ship->capacity }} persons</p>
                </div>
                <div class="col-md-6">
                    <h5>Booking Information</h5>
                    <p><strong>Start Date:</strong> {{ $booking->start_date->format('M d, Y') }}</p>
                    <p><strong>End Date:</strong> {{ $booking->end_date->format('M d, Y') }}</p>
                    <p><strong>Total Price:</strong> {{ format_idr($booking->total_price) }}</p>
                    <p>
                        <strong>Status:</strong> 
                        @if($booking->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                        @elseif($booking->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                        @elseif($booking->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </p>
                </div>
            </div>
            
            @if($booking->notes)
            <div class="mt-4">
                <h5>Notes</h5>
                <p>{{ $booking->notes }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection