<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerahTerimaItems extends Model
{
    //
   protected $fillable = [
    'serah_terima_id',
    'item_name',
    'is_checked',
    'status',
    'keterangan',
];
}
