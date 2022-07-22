<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SensorController extends Controller

{
    public function index()
    {
        $suhu = DB::table('data')->select('suhu')->get();
        $kelembaban = DB::table('data')->select('kelembaban')->get();

        $valsuhu = [];
        $valkelembaban = [];

        foreach ($kelembaban as $val) {
            $valkelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valsuhu[] = $val->suhu;
        }
        $data = [
            'suhu' => $valsuhu,
            'kelembaban' => $valkelembaban
        ];
        return view('ajax.index', $data);
    }
    public function dataterakhir()
    {
        $query = DB::table('data')->orderBy('id', 'DESC')->first();
        return json_encode([
            'status' => 200,
            'data' => $query
        ]);
    }
    public function dataGrafik()
    {
        $suhu = DB::table('data')->select('suhu')->get();
        $kelembaban = DB::table('data')->select('kelembaban')->get();

        $valsuhu = [];
        $valkelembaban = [];

        foreach ($kelembaban as $val) {
            $valkelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valsuhu[] = $val->suhu;
        }
        return json_encode([
            'status'    => 200,
            'suhu'      => $valsuhu,
            'kelembaban' => $valkelembaban
        ]);
    }
}
