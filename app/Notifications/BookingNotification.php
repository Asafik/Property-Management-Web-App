<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    use Queueable;

    protected $booking;

    /**
     * Buat instance notifikasi dengan data booking.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Tentukan channel notifikasi.
     */
    public function via($notifiable)
    {
        return ['database']; // simpan ke database
    }

    /**
     * Data yang disimpan di tabel notifications.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Booking Baru',
            'message' => 'Ada pengajuan booking baru',
            'booking_id' => $this->booking->id ?? null // aman kalau null
        ];
    }

    /**
     * Optional: Bisa ditampilkan juga di broadcast/email jika mau.
     */
    // public function toBroadcast($notifiable) { ... }
    // public function toMail($notifiable) { ... }
}