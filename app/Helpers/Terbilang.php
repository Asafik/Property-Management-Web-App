<?php

namespace App\Helpers;

class Terbilang
{
    private static $angka = [
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 
        'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'
    ];

    public static function make($x)
    {
        $x = (int)$x;
        if ($x < 12) {
            return self::$angka[$x];
        } elseif ($x < 20) {
            return self::make($x - 10) . ' belas';
        } elseif ($x < 100) {
            return self::make(intval($x / 10)) . ' puluh' . 
                   ($x % 10 != 0 ? ' ' . self::make($x % 10) : '');
        } elseif ($x < 200) {
            return 'seratus' . ($x - 100 != 0 ? ' ' . self::make($x - 100) : '');
        } elseif ($x < 1000) {
            return self::make(intval($x / 100)) . ' ratus' . 
                   ($x % 100 != 0 ? ' ' . self::make($x % 100) : '');
        } elseif ($x < 2000) {
            return 'seribu' . ($x - 1000 != 0 ? ' ' . self::make($x - 1000) : '');
        } elseif ($x < 1000000) {
            return self::make(intval($x / 1000)) . ' ribu' . 
                   ($x % 1000 != 0 ? ' ' . self::make($x % 1000) : '');
        } elseif ($x < 1000000000) {
            return self::make(intval($x / 1000000)) . ' juta' . 
                   ($x % 1000000 != 0 ? ' ' . self::make($x % 1000000) : '');
        } else {
            return 'nomor terlalu besar';
        }
    }
}