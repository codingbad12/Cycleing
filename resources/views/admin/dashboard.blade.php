@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Admin Dashboard</h1>
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Ships</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_ships'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ship fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Rented Ships</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['rented_ships'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-anchor fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_bookings'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Bookings</h6>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Ship</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->ship->name }}</td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($booking->status == 'approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($booking->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'pending')
                                            <a href="{{ route('admin.bookings.approve', $booking->id) }}" class="btn btn-sm btn-success">Approve</a>
                                            <a href="{{ route('admin.bookings.reject', $booking->id) }}" class="btn btn-sm btn-danger">Reject</a>
                                        @else
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No bookings found</td>
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