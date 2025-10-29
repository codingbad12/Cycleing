@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Bookings</h2>
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="card shadow">
        <div class="card-body">
            @if($bookings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Ship</th>
                            <th>Dates</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->ship->name }}</td>
                            <td>{{ $booking->start_date->format('M d, Y') }} - {{ $booking->end_date->format('M d, Y') }}</td>
                            <td>{{ format_idr($booking->total_price) }}</td>
                            <td>
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
                            </td>
                            <td>
                                <a href="{{ route('user.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                @if($booking->status == 'approved')
                                <form action="{{ route('user.bookings.return', $booking->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure you want to return this ship?')">
                                        Return Ship
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-4">
                <h5>You don't have any bookings yet</h5>
                <p>Browse our ships and make your first booking!</p>
                <a href="{{ route('ships.index') }}" class="btn btn-primary mt-2">Browse Ships</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection