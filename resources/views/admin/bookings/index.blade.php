@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Booking Management</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" 
                       href="{{ route('admin.bookings.index', ['status' => 'pending']) }}">
                        Pending Approvals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" 
                       href="{{ route('admin.bookings.index', ['status' => 'approved']) }}">
                        Approved
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'return_requested' ? 'active' : '' }}" 
                       href="{{ route('admin.bookings.index', ['status' => 'return_requested']) }}">
                        Return Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'completed' ? 'active' : '' }}" 
                       href="{{ route('admin.bookings.index', ['status' => 'completed']) }}">
                        Completed
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" 
                       href="{{ route('admin.bookings.index', ['status' => 'rejected']) }}">
                        Rejected
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Ship</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Guests</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->user->name ?? 'Unknown' }}</td>
                            <td>{{ $booking->ship->name ?? 'Unknown' }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ $booking->guests }}</td>
                            <td>${{ number_format($booking->total_price, 2) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($status == 'pending')
                                    <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                    @elseif($status == 'return_requested')
                                    <form action="{{ route('admin.bookings.confirm-return', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Confirm Return
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No bookings found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection