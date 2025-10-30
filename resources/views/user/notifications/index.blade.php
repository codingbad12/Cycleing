@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Notifications</h2>
        <div>
            <a href="{{ route('notifications.markAllAsRead') }}" class="btn btn-outline-primary">Mark All as Read</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($notifications->count() > 0)
                <div class="list-group">
                    @foreach($notifications as $notification)
                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $notification->read_at ? 'bg-light' : '' }}">
                            <div class="ms-2 me-auto">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h5>
                                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ $notification->data['message'] ?? '' }}</p>
                                <div class="d-flex mt-2">
                                    @if(!$notification->read_at)
                                        <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary me-2">Mark as Read</a>
                                    @endif
                                    @if(isset($notification->data['link']))
                                        <a href="{{ $notification->data['link'] }}" class="btn btn-sm btn-info me-2">View</a>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <span class="badge rounded-pill bg-{{ $notification->data['type'] ?? 'info' }} ms-2">
                                {{ ucfirst($notification->data['type'] ?? 'info') }}
                            </span>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->links() }}
                </div>
            @else
                <p class="text-center">No notifications found.</p>
            @endif
        </div>
    </div>
</div>
@endsection