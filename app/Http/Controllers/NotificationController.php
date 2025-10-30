<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->paginate(10);
        return view('user.notifications.index', compact('notifications'));
    }
    
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        // If notification has data with a link, redirect to it
        if (isset($notification->data['link'])) {
            return redirect($notification->data['link']);
        }
        
        return redirect()->route('notifications.index')
            ->with('success', 'Notification marked as read.');
    }
    
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        
        return redirect()->route('notifications.index')
            ->with('success', 'All notifications marked as read.');
    }
    
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        
        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }
}