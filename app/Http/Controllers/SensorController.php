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
        $nilaiPh = DB::table('data')->select('nilai_ph')->get();

        $valSuhu = [];
        $valKelembaban = [];
        $valPh = [];

        foreach ($kelembaban as $val) {
            $valKelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valSuhu[] = $val->suhu;
        }

        foreach ($nilaiPh as $val) {
            $valPh[] = $val->nilai_ph;
        }

        $data = [
            'suhu' => $valSuhu,
            'kelembaban' => $valKelembaban,
            'nilai' => $valPh
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
        $nilaiPh = DB::table('data')->select('nilai_ph')->get();

        $valSuhu = [];
        $valKelembaban = [];
        $valPh = [];

        foreach ($kelembaban as $val) {
            $valKelembaban[] = $val->kelembaban;
        }

        foreach ($suhu as $val) {
            $valSuhu[] = $val->suhu;
        }

        foreach ($nilaiPh as $val) {
            $valPh[] = $val->nilai_ph;
        }
        return json_encode([
            'status'    => 200,
            'suhu'      => $valSuhu,
            'kelembaban' => $valKelembaban,
            'nilai'     => $valPh
        ]);
    }
}
