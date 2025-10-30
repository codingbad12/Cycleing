@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" class="rounded-circle img-fluid" alt="Profile Picture">
                    </div>
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted">Member since {{ $user->created_at->format('M Y') }}</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        <a href="{{ route('profile.password') }}" class="btn btn-outline-secondary">Change Password</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Content -->
        <div class="col-lg-9">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <!-- Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking History -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Booking History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ship</th>
                                    <th>Type</th>
                                    <th>Dates</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->ship->name }}</td>
                                    <td>{{ $booking->ship->type }}</td>
                                    <td>{{ $booking->start_date->format('M d, Y') }} to {{ $booking->end_date->format('M d, Y') }}</td>
                                    <td>${{ number_format($booking->total_price, 2) }}</td>
                                    <td>
                                        @if($booking->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($booking->status == 'active')
                                            <span class="badge bg-info">Active</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($booking->status == 'return_requested')
                                            <span class="badge bg-secondary">Return Requested</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No booking history found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection