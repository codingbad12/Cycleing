<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatuses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:update-statuses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update booking statuses based on dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Update approved bookings to active if start date has arrived
        $approvedBookings = Booking::where('status', Booking::STATUS_APPROVED)
            ->where('start_date', '<=', Carbon::now())
            ->get();

        $count = 0;
        foreach ($approvedBookings as $booking) {
            $booking->status = 'active';
            $booking->save();
            $count++;
        }

        $this->info("Updated {$count} bookings to active status.");
    }
}