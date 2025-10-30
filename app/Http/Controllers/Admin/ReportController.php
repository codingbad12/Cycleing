<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ship;
use App\Models\User;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard
     */
    public function index()
    {
        $totalRevenue = Booking::where('status', 'completed')->sum('total_price');
        $totalLateFees = Booking::where('status', 'completed')->sum('late_fee');
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();
        
        $recentInvoices = Booking::with(['user', 'ship'])
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.reports.index', compact(
            'totalRevenue', 
            'totalLateFees', 
            'totalBookings', 
            'completedBookings', 
            'recentInvoices'
        ));
    }
    
    /**
     * Generate custom reports
     */
    public function generate(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        
        $bookings = Booking::with(['user', 'ship'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();
            
        $revenue = $bookings->where('status', 'completed')->sum('total_price');
        $lateFees = $bookings->where('status', 'completed')->sum('late_fee');
        
        $bookingsByStatus = [
            'pending' => $bookings->where('status', 'pending')->count(),
            'approved' => $bookings->where('status', 'approved')->count(),
            'completed' => $bookings->where('status', 'completed')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
        ];
        
        return view('admin.reports.generate', compact(
            'bookings', 
            'startDate', 
            'endDate', 
            'revenue', 
            'lateFees', 
            'bookingsByStatus'
        ));
    }
    
    /**
     * Display an invoice
     */
    public function invoice($id)
    {
        $booking = Booking::with(['user', 'ship'])->findOrFail($id);
        
        if ($booking->status !== 'completed') {
            return redirect()->back()->with('error', 'Invoice is only available for completed bookings');
        }
        
        return view('admin.reports.invoice', compact('booking'));
    }
    
    /**
     * Print an invoice
     */
    public function printInvoice($id)
    {
        $booking = Booking::with(['user', 'ship'])->findOrFail($id);
        
        if ($booking->status !== 'completed') {
            return redirect()->back()->with('error', 'Invoice is only available for completed bookings');
        }
        
        return view('admin.reports.print-invoice', compact('booking'));
    }
}