<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dht11 extends Controller
{
    public function terimaData($suhu, $kelembaban)
    {


        $count = DB::table('data')->count();

        if ($count > 20) {
            DB::table('data')->truncate();
        }


        $data = [
            'Suhu' => $suhu,
            'Kelembaban' => $kelembaban
        ];

        DB::table('data')->insert($data);

        return response()->json([
            'status' => 200,
            'Suhu'   => $suhu,
            'Kelembaban' => $kelembaban
        ]);
    }
}
