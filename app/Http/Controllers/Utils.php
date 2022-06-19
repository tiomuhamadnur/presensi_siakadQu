<?php

namespace App\Http\Controllers;

trait Utils
{
    public function getDayRedaction(int $number)
    {
        switch (strtolower($number)) {
            case 2:
                $dayRedaction = 'selasa';
                break;
            case 3:
                $dayRedaction = 'rabu';
                break;
            case 4:
                $dayRedaction = 'kamis';
                break;
            case 5:
                $dayRedaction = 'jumat';
                break;
            case 6:
                $dayRedaction = 'sabtu';
                break;
            case 7:
                $dayRedaction = 'minggu';
                break;
            default:
                $dayRedaction = 'senin';
        }
        return $dayRedaction;
    }
}
