<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('ship')->latest()->get();
        return view('user.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Auth::user()->bookings()->with('ship')->findOrFail($id);
        return view('user.bookings.show', compact('booking'));
    }

    public function returnShip($id)
    {
        $booking = Auth::user()->bookings()->with('ship')->findOrFail($id);
        
        if ($booking->status !== 'active') {
            return back()->with('error', 'Only active bookings can be returned.');
        }

        $booking->status = 'return_requested';
        $booking->save();

        return redirect()->route('user.bookings.index')
            ->with('success', 'Return request submitted successfully. Please wait for admin confirmation.');
    }
}