<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use App\Notifications\FineNotification;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing a user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);
        
        Log::info('Admin updated user', ['user_id' => $id]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Fine a user for exceeding ship booking
     */
    public function fine($id)
    {
        try {
            $user = User::findOrFail($id);
            
            Log::info('Starting fine process for user', [
                'user_id' => $id,
                'user_exists' => $user ? true : false,
                'user_data' => $user->toArray()
            ]);

            // Create a new penalty with proper quotes for strings
            $penalty = new \App\Models\Penalty();
            $penalty->user_id = $user->id;
            $penalty->amount = 50000;
            $penalty->reason = 'Exceeding ship booking';
            $penalty->status = 'pending';
            $penalty->notes = 'Administrative fine for exceeding ship booking time limit';
            $penalty->booking_id = null;
            $penalty->save();
            
            Log::info('Penalty created', ['penalty_id' => $penalty->id, 'penalty_data' => $penalty->toArray()]);
            
            // Send notification using Laravel's notification system
            $user->notify(new \App\Notifications\FineNotification(50000, 'exceeding ship booking'));
            
            Log::info('Notification sent to user');
            
            return redirect()->route('admin.users.index')
                ->with('success', 'User has been fined successfully');
                
        } catch (\Exception $e) {
            Log::error('Failed to create penalty', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $id
            ]);
            
            return redirect()->route('admin.users.index')
                ->with('error', 'Failed to create penalty: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Check if user has active bookings
        $activeBookings = Booking::where('user_id', $id)
            ->whereIn('status', ['pending', 'approved', 'active'])
            ->exists();
            
        if ($activeBookings) {
            return redirect()->back()
                ->with('error', 'Cannot delete user with active bookings');
        }
        
        $user->delete();
        
        Log::info('Admin deleted user', ['user_id' => $id]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User removed successfully');
    }

    /**
     * Display user rental history
     */
    public function rentalHistory($id)
    {
        $user = User::findOrFail($id);
        $bookings = Booking::with('ship')
            ->where('user_id', $id)
            ->latest()
            ->paginate(10);
            
        return view('admin.users.history', compact('user', 'bookings'));
    }
}