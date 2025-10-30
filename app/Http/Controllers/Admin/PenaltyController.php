<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Penalty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with(['user', 'booking'])->latest()->paginate(10);
        return view('admin.penalties.index', compact('penalties'));
    }

    public function create()
    {
        $users = User::all();
        $bookings = Booking::where('status', 'completed')->get();
        return view('admin.penalties.create', compact('users', 'bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,paid,waived',
        ]);

        if ($validated['status'] === 'paid') {
            $validated['paid_at'] = now();
        }

        Penalty::create($validated);

        return redirect()->route('admin.penalties.index')
            ->with('success', 'Penalty created successfully.');
    }

    public function show(Penalty $penalty)
    {
        return view('admin.penalties.show', compact('penalty'));
    }

    public function edit(Penalty $penalty)
    {
        $users = User::all();
        $bookings = Booking::where('status', 'completed')->get();
        return view('admin.penalties.edit', compact('penalty', 'users', 'bookings'));
    }

    public function update(Request $request, Penalty $penalty)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'amount' => 'required|numeric|min:0',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,paid,waived',
        ]);

        // If status changed to paid, set paid_at timestamp
        if ($validated['status'] === 'paid' && $penalty->status !== 'paid') {
            $validated['paid_at'] = now();
        }
        
        // If status changed from paid, clear paid_at timestamp
        if ($validated['status'] !== 'paid' && $penalty->status === 'paid') {
            $validated['paid_at'] = null;
        }

        $penalty->update($validated);

        return redirect()->route('admin.penalties.index')
            ->with('success', 'Penalty updated successfully.');
    }

    public function destroy(Penalty $penalty)
    {
        $penalty->delete();
        return redirect()->route('admin.penalties.index')
            ->with('success', 'Penalty deleted successfully.');
    }

    // Automatically calculate penalties for late returns
    public function calculateLatePenalties()
    {
        // Find bookings that are overdue (end_date < current date and status is still 'active')
        $overdueBookings = Booking::where('status', 'active')
            ->where('end_date', '<', now()->format('Y-m-d'))
            ->get();
        
        $penaltiesCreated = 0;
        
        foreach ($overdueBookings as $booking) {
            // Calculate days overdue
            $endDate = \Carbon\Carbon::parse($booking->end_date);
            $daysOverdue = now()->diffInDays($endDate);
            
            // Only apply penalty if more than 1 day overdue
            if ($daysOverdue > 1) {
                // Calculate penalty amount (e.g., $20 per day overdue)
                $penaltyAmount = $daysOverdue * 20;
                
                // Check if penalty already exists for this booking
                $existingPenalty = Penalty::where('booking_id', $booking->id)
                    ->where('reason', 'like', 'Late return%')
                    ->first();
                
                if (!$existingPenalty) {
                    // Create new penalty
                    Penalty::create([
                        'user_id' => $booking->user_id,
                        'booking_id' => $booking->id,
                        'amount' => $penaltyAmount,
                        'reason' => "Late return - {$daysOverdue} days overdue",
                        'status' => 'pending',
                    ]);
                    
                    $penaltiesCreated++;
                }
            }
        }
        
        return redirect()->route('admin.penalties.index')
            ->with('success', "{$penaltiesCreated} new late return penalties created.");
    }
}