@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Penalties</h2>
        <div>
            <a href="{{ route('admin.penalties.calculate') }}" class="btn btn-warning me-2">Calculate Late Penalties</a>
            <a href="{{ route('admin.penalties.create') }}" class="btn btn-primary">Add New Penalty</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Booking</th>
                            <th>Amount</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penalties as $penalty)
                            <tr>
                                <td>{{ $penalty->id }}</td>
                                <td>{{ $penalty->user->name }}</td>
                                <td>{{ $penalty->booking->id }}</td>
                                <td>${{ number_format($penalty->amount, 2) }}</td>
                                <td>{{ $penalty->reason }}</td>
                                <td>
                                    @if($penalty->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($penalty->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($penalty->status == 'waived')
                                        <span class="badge bg-secondary">Waived</span>
                                    @endif
                                </td>
                                <td>{{ $penalty->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.penalties.show', $penalty) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.penalties.edit', $penalty) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.penalties.destroy', $penalty) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this penalty?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No penalties found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $penalties->links() }}
            </div>
        </div>
    </div>
</div>
@endsection