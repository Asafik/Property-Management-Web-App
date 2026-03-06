<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    use Queueable;

    protected $kpr;

    public function __construct($kpr)
    {
        $this->kpr = $kpr;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Booking Baru',
            'message' => 'Ada pengajuan KPR baru',
            'booking_id' => $this->kpr->booking_id
        ];
    }
}