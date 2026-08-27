<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
// Jika butuh dikirim via email juga, uncomment baris di bawah:
// use Illuminate\Notifications\Messages\MailMessage;

class NewTaskNotification extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Menyimpan data tugas yang dilempar dari Controller
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Pilih jalur pengiriman notifikasi. 
     * 'database' berarti akan disimpan ke tabel notifications.
     */
    public function via(object $notifiable): array
    {
        return ['database']; 
    }

    /**
     * Format data yang akan disimpan ke kolom 'data' di tabel notifications
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'nama_tugas' => $this->task->nama_tugas,
            'message' => 'Anda ditugaskan untuk: ' . $this->task->nama_tugas,
            // Kamu bisa menambahkan data lain misal deadline dll di sini
        ];
    }
}