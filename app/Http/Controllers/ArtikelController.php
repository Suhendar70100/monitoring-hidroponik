<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $data = [
            'articles'  => DB::table('artikels')->get(),
        ];

        return view('admin.artikel.index', $data);
    }

    public function insert()
    {

        return view('admin.artikel.insert');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'namaArtikel' => 'required|max:50',
            'kontenArtikel' => 'required',
            'status' => 'required|max:2'

        ]);

        $data = [
            'idArtikel'      => $request->idArtikel,
            'namaArtikel'    => $request->namaArtikel,
            'kontenArtikel'  => $request->kontenArtikel,
            'status'         => $request->status,
            'gambarArtikel'  => $request->gambarArtikel,
            'tglArtikel'     => date('Y-m-d H:i:s')
        ];

        DB::table('artikels')->insert($data);
        return redirect()->route('artikel')->with('success', 'Data berhasil Di simpan');
    }
    // public function delete(Request $request)
    // {
    //     // 
    //     // dd($request->all());
    //     $data = DB::table('artikels')->where('idArtikel', $request->idArtikel)->delete();
    //     // dd($data);
    //     return redirect()->route('artikel')->with('success', 'Data Berhasil Dihapus');
    // }
    public function destroy()
    {
        // $data = DB::table('artikels')->get();

        if (request()->idArtikel == 19) {
            return redirect()->route('artikel')->with('failed', 'Data ini tidak bisa dihapus');
        } else {
            DB::table('artikels')->where('idArtikel', request()->idArtikel)->delete();
            return redirect()->route('artikel')->with('success', 'Data berhasil terhapus');
        }
    }

    // public function update(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'namaArtikel' => 'required|max:50',
    //         'kontenArtikel' => 'required',
    //         'status' => 'required|max:2'

    //     ]);

    //     $data = [
    //         'idArtikel'      => $request->idArtikel,
    //         'namaArtikel'    => $request->namaArtikel,
    //         'kontenArtikel'  => $request->kontenArtikel,
    //         'status'         => $request->status,
    //         'gambarArtikel'  => $request->gambarArtikel,
    //         'tglArtikel'     => date('Y-m-d H:i:s')
    //     ];
    //     // Post::where('idArtikel', $artikel->idArtikel)
    //     //     ->update($data);
    //     DB::table('artikels')->update($data);
    //     return redirect()->route('artikel')->with('success', 'Data berhasil Di Update');
    // }

    public function edit($id)
    {

        $data = [
            'artikels' => DB::table('artikels')->where('idArtikel', $id)->first()
        ];
        return view('admin.artikel.edit', $data);
    }

    public function update()
    {
        $id = request()->idArtikel;

        $data = [
            'namaArtikel'   => request()->namaArtikel,
            'kontenArtikel' => request()->kontenArtikel,
            'status'        => request()->status,
            'gambarArtikel' => request()->gambarArtikel
        ];



        DB::table('artikels')->where('idArtikel', $id)->update($data);

        return redirect()->route('artikel')->with('success', 'Data berhasil Di simpan');
    }

    public function suhu()
    {
        return view('admin.artikel.suhu');
    }
}
