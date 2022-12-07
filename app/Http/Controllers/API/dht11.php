<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dht11 extends Controller
{
    public function terimaData($suhu, $kelembaban, $pH)
    {


        $count = DB::table('data')->count();

        if ($count > 20) {
            DB::table('data')->truncate();
        }


        $data = [
            'suhu' => $suhu,
            'kelembaban' => $kelembaban,
            'ph' => $pH
        ];

        DB::table('data')->insert($data);

        return response()->json([
            'status' => 200,
            'suhu'   => $suhu,
            'kelembaban' => $kelembaban,
            'pH' => $pH
        ]);
    }
}
