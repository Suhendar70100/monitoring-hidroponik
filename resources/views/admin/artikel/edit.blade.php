@extends('layouts.app')

@section('content')

{{-- <pre>
    {{ print_r($artikels) }}
</pre> --}}


    <div class="container">

        <form action="/artikel/update" method="post">
            @csrf
            <input type="hidden" name="idArtikel" value="{{ $artikels->idArtikel }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Artikel</label>
                <input type="text" class="form-control @error('namaArtikel') is-invalid @enderror " id="exampleInputEmail1" name="namaArtikel" required autofocus value="{{ $artikels->namaArtikel }}">
                @error('namaArtikel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Status</label>
                <input type="text" class="form-control @error('status') is-invalid @enderror " id="exampleInputEmail1" name="status" required autofocus value="{{ $artikels->status}}">
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">gambar </label>
                <input type="text" class="form-control @error('gambarArtikel') is-invalid @enderror " id="exampleInputEmail1" name="gambarArtikel" required autofocus value="{{ $artikels->gambarArtikel}}">
                @error('gambarArtikel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kontentarea" class="form-label">Kontent Artikel</label>
                <textarea class="form-control @error('kontenArtikel') is-invalid @enderror" cols="30" rows="10" name="kontenArtikel" id="kontentarea" required autofocus >{{ $artikels->kontenArtikel }}</textarea>
                @error('kontenArtikel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection