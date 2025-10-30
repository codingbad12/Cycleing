<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Auth middleware is applied in routes file
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $user = Auth::user();
        
        // Get user's booking history
        $bookings = $user->bookings()->with('ship')->latest()->get();
        
        return view('user.profile.show', compact('user', 'bookings'));
    }

    /**
     * Show the form for editing the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }

    /**
     * Show the form for changing password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showChangePasswordForm()
    {
        return view('user.profile.change-password');
    }

    /**
     * Change the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }
        
        $user->password = Hash::make($validated['password']);
        $user->save();
        
        return redirect()->route('profile.show')->with('success', 'Password changed successfully');
    }
    
    /**
     * Get dummy bookings for the current user.
     * In a real application, this would fetch from the database.
     *
     * @return array
     */
    private function getDummyBookings()
    {
        return [
            [
                'id' => 1,
                'ship_name' => 'Luxury Yacht',
                'ship_type' => 'Yacht',
                'start_date' => '2023-06-15',
                'end_date' => '2023-06-18',
                'total_price' => 3600,
                'status' => 'completed'
            ],
            [
                'id' => 2,
                'ship_name' => 'Speed Demon',
                'ship_type' => 'Speedboat',
                'start_date' => '2023-07-10',
                'end_date' => '2023-07-12',
                'total_price' => 1000,
                'status' => 'completed'
            ],
            [
                'id' => 3,
                'ship_name' => 'Family Cruiser',
                'ship_type' => 'Pontoon',
                'start_date' => '2023-08-05',
                'end_date' => '2023-08-07',
                'total_price' => 600,
                'status' => 'active'
            ],
        ];
    }
}