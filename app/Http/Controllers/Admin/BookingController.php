<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        $bookings = Booking::where('status', $status)
            ->with(['user', 'ship'])
            ->latest()
            ->paginate(10);
            
        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    /**
     * Display the specified booking
     */
    public function show($id)
    {
        $booking = Booking::with(['user', 'ship'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Approve a booking
     */
    public function approve($id)
    {
        $booking = Booking::with(['user', 'ship'])->findOrFail($id);
        
        // Check if user already has 2 active rentals
        $activeRentals = Booking::where('user_id', $booking->user_id)
            ->whereIn('status', ['approved', 'active'])
            ->count();
            
        if ($activeRentals >= 2) {
            return redirect()->back()->with('error', 'User already has the maximum of 2 active rentals');
        }
        
        // Check if ship is available
        if ($booking->ship->status !== 'available') {
            return redirect()->back()->with('error', 'Ship is no longer available');
        }
        
        // Update booking status based on start date
        if (now()->startOfDay()->gte($booking->start_date->startOfDay())) {
            $booking->status = 'active';
        } else {
            $booking->status = 'approved';
        }
        $booking->save();

        // If today is the start date, update to active
        if ($booking->status === 'approved' && now()->format('Y-m-d') === $booking->start_date->format('Y-m-d')) {
            $booking->status = 'active';
            $booking->save();
        }
        
        // Update ship status
        $booking->ship->status = 'rented';
        $booking->ship->save();
        
        Log::info('Admin approved booking', [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'ship_id' => $booking->ship_id
        ]);
        
        // In a real app, you would send notification to user
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking approved successfully');
    }

    /**
     * Reject a booking
     */
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();
        
        Log::info('Admin rejected booking', [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'ship_id' => $booking->ship_id
        ]);
        
        // In a real app, you would send notification to user
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking rejected');
    }

    /**
     * Confirm ship return
     */
    public function confirmReturn($id)
    {
        $booking = Booking::with('ship')->findOrFail($id);
        
        // Check if booking is in the correct status
        if ($booking->status !== 'return_requested') {
            return redirect()->back()->with('error', 'Return has not been requested for this booking');
        }
        
        // Update booking status
        $booking->status = 'completed';
        $booking->actual_return_date = now();
        $booking->save();
        
        // Update ship status
        $booking->ship->status = 'available';
        $booking->ship->save();
        
        // Check for late return (5-day maximum)
        $dueDate = date('Y-m-d', strtotime($booking->start_date . ' + 5 days'));
        $actualReturn = date('Y-m-d', strtotime($booking->actual_return_date));
        
        if ($actualReturn > $dueDate) {
            // Apply late fee
            $booking->late_fee = 5000;
            $booking->save();
            
            // In a real app, you would send notification to user about late fee
        }
        
        Log::info('Admin confirmed ship return', [
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'ship_id' => $booking->ship_id,
            'late_fee' => $booking->late_fee ?? 0
        ]);
        
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Ship return confirmed successfully');
    }
}