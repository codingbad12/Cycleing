<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FineNotification extends Notification
{
    use Queueable;

    private $amount;
    private $reason;

    /**
     * Create a new notification instance.
     */
    public function __construct($amount, $reason)
    {
        $this->amount = $amount;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Fine Issued',
            'message' => 'You have been fined Rp. ' . number_format($this->amount) . ' for ' . $this->reason,
            'type' => 'fine',
            'amount' => $this->amount,
            'reason' => $this->reason
        ];
    }
}