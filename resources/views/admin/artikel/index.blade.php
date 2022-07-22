@extends('layouts.app')

@section('content')
   
    <div class="row">
        <div class="col-sm-12">
            @include('notifikasi')
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Data Artikel </h4><a href="/artikel/insert" class="btn btn-primary">Create</a>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Artikel</th>
                                    <th>Konten</th>
                                    <th>Status</th>
                                    <th>Gambar</th>
                                    <th>Tgl Artikel</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            @foreach ($articles as $index => $artikel)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ ucwords($artikel->namaArtikel) }}</td>
                                    <td>{{ $artikel->kontenArtikel }}</td>
                                    <td>{{ $artikel->status }}</td>
                                    <td>{{ $artikel->gambarArtikel }}</td>
                                    <td>{{ $artikel->tglArtikel }}</td>
                                    <td>
                                        <form action="/artikel/delete" method="post" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="idArtikel" value="{{ $artikel->idArtikel }}">
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin Untuk Dihapus?')" type="submit"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="/artikel/edit/{{ $artikel->idArtikel }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection