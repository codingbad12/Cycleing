<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ship;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get real data from database
        $stats = [
            'total_ships' => Ship::count(),
            'rented_ships' => Ship::where('status', 'rented')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'revenue' => Booking::where('status', 'approved')->sum('total_price')
        ];
        
        // Get recent bookings
        $recentBookings = Booking::with(['user', 'ship'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}