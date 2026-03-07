<?php

namespace App\Imports;

use App\Models\LandBankUnit;
use App\Models\units;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LandBankUnitImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
     public function model(array $row)
    {
        return new LandBankUnit([
            'unit_code' => $row['unit_code'],
            'type' => $row['type'],
            'status' => $row['status'],
            'construction_progress' => $row['construction_progress'],
            'land_bank_id' => $row['land_bank_id'], // sesuaikan
            'area' => $row['area'],
            'price' => $row['price'],
            'building_area' => $row['building_area'],
        ]);
    }
}
