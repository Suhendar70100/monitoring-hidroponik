<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dht11 extends Component
{
    public $data_akhir;
    public $data_kelembaban;
    public $days = [];
    public $subscriber = [30, 40, 35, 50, 49, 60, 70, 91, 125];

    public $recenSubscriber = 125;

    public function mount()
    {
        $this->days = collect(range(1, 31))->map(function ($number) {
            return 'April ' . $number;
        });
    }
    public function render()
    {
        $maxId = DB::table('data')->orderby('id', 'desc')->max('id');
        // $query = DB::table('data')->where('id', $maxId)->first();
        $query = DB::table('data')->orderBy('id', 'desc')->paginate(10);
        // $suhu = dd($query);  
        return view(
            'livewire.dht11',
            [
                'query' => $query,
            ]

        );
    }
    public function data()
    {
        // dd("ja");
        $data_akhir = DB::table('data')->orderBy('id', 'desc')->first();
        // dd($data_akhir);
        $this->data_akhir = $data_akhir->suhu;
        $this->data_kelembaban = $data_akhir->kelembaban;
    }
}
