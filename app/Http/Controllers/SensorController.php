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
        $pH = DB::table('data')->select('ph')->get();

        $valSuhu = [];
        $valKelembaban = [];
        $valPH = [];

        foreach ($kelembaban as $val) {
            $valKelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valSuhu[] = $val->suhu;
        }

        foreach ($pH as $val) {
            $valPH[] = $val->ph;
        }

        $data = [
            'suhu' => $valSuhu,
            'kelembaban' => $valKelembaban,
            'pH' => $valPH
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
        $ph = DB::table('data')->select('ph')->get();

        $valSuhu = [];
        $valKelembaban = [];
        $valPH = [];

        foreach ($kelembaban as $val) {
            $valKelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valSuhu[] = $val->suhu;
        }

        foreach ($ph as $val) {
            $valPH[] = $val->ph;
        }

        return json_encode([
            'status'    => 200,
            'suhu'      => $valSuhu,
            'kelembaban' => $valKelembaban,
            'ph' => $valPH
        ]);
    }
}
