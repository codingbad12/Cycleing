<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;
use App\Models\Ship;
use App\Models\User;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard()
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
    
    // Admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    
    // Alias for backward compatibility
    public function loginForm()
    {
        return $this->showLoginForm();
    }
    
    // Admin login process
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Check user role via is_admin flag
        if (Auth::attempt($credentials) && Auth::user()->is_admin) {
            $request->session()->regenerate();
            
            // Log admin login
            Log::info('Admin logged in', ['admin_id' => Auth::id(), 'email' => Auth::user()->email, 'ip' => $request->ip()]);
            
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you do not have admin privileges.',
        ]);
    }
    
    // Admin logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }
}