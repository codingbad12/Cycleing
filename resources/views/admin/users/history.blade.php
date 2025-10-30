@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rental History: {{ $user->name }}</h1>
        <a href="{{ route('admin.users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Users
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bookings</h6>
        </div>
        <div class="card-body">
            @if($bookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ship</th>
                                <th>Dates</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th>Late Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->ship->name }}</td>
                                <td>
                                    {{ date('M d, Y', strtotime($booking->start_date)) }} - 
                                    {{ date('M d, Y', strtotime($booking->end_date)) }}
                                </td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($booking->status == 'approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif($booking->status == 'completed')
                                        <span class="badge badge-primary">Completed</span>
                                    @elseif($booking->status == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @elseif($booking->status == 'return_requested')
                                        <span class="badge badge-info">Return Requested</span>
                                    @endif
                                </td>
                                <td>${{ number_format($booking->total_price, 2) }}</td>
                                <td>${{ number_format($booking->late_fee ?? 0, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    @if($booking->status == 'completed')
                                        <a href="{{ route('admin.reports.invoice', $booking->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-invoice"></i> Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $bookings->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <h5>No booking history found</h5>
                    <p class="text-muted">This user hasn't made any bookings yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection