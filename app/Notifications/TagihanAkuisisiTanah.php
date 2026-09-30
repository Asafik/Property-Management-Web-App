<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TagihanAkuisisiTanah extends Notification
{
    use Queueable;

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'        => 'tagihan_akuisisi_tanah',
            'title'       => 'Tagihan Akuisisi Tanah: ' . ($this->data['land_name'] ?? '-'),
            'land_id'     => $this->data['land_id'] ?? null,
            'land_name'   => $this->data['land_name'] ?? '-',
            'deal_price'  => $this->data['deal_price'] ?? 0,
            'grand_total' => $this->data['grand_total'] ?? 0,
            'message'     => 'Keputusan sidang untuk ' . ($this->data['land_name'] ?? '-') . ' telah disetujui (DIAMBIL). Tagihan pembayaran sebesar Rp ' . number_format($this->data['grand_total'] ?? 0, 0, ',', '.') . ' telah diterbitkan.',
            'url'         => $this->data['pra_landbank_url'] ?? '#',
        ];
    }
}
