<?php

namespace App\Exports;

use App\Models\LandBankUnit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitsExport implements FromCollection, WithHeadings
{
    public function collection()
{
    return LandBankUnit::with([
        'landBank',
        'activeBooking.sales'
    ])->get()->map(function ($unit) {

        $booking = $unit->activeBooking;

        return [
            $unit->unit_code,
            $unit->landBank->name ?? '-',
            $unit->price,
            $unit->status,
            optional(optional($booking)->sales)->name ?? '-',
            optional($booking)->agent_fee ?? 0,
        ];
    });
}

    public function headings(): array
    {
        return [
            'Blok',
            'Nama Project',
            'Harga Unit',
            'Status',
            'Nama Agent',
            'Agent Fee',
        ];
    }
}