<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status {id} {status}';
    protected $description = 'Update a booking status';

    public function handle()
    {
        $booking = Booking::findOrFail($this->argument('id'));
        $booking->status = $this->argument('status');
        $booking->save();

        $this->info("Updated booking {$booking->id} to status {$booking->status}");
    }
}