<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class switchController extends Controller
{
    public function index()
    {
        $data = DB::table('akuator')->where('id', 1)->first();

        // $data = [
        //     'waterPump' => DB::table('akuator')->where('id', 1)->first()
        // ];
        // return view('ajax.index', $data);

        return response()->json([
            "waterpump" => $data->water_pump
        ]);
    }

    public function store(Request $request)
    {
        DB::table('akuator')->where('id', 1)->update([
            "water_pump" => $request->switch 
        ]);

        return response()->json([
            "message" => "success",
            "switch" => $request->switch
        ]);
        // return dd($request->switch);
    }
}