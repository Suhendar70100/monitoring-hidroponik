@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="/artikel/insert" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Artikel</label>
                <input type="text" class="form-control @error('namaArtikel') is-invalid @enderror " id="exampleInputEmail1" name="namaArtikel" required autofocus value="{{ old('namaArtikel')}}">
                @error('namaArtikel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Status</label>
                <input type="text" class="form-control @error('status') is-invalid @enderror " id="exampleInputEmail1" name="status" required autofocus value="{{ old('status')}}">
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">gambar </label>
                <input type="text" class="form-control @error('gambarArtikel') is-invalid @enderror " id="exampleInputEmail1" name="gambarArtikel" required autofocus value="{{ old('gambarArtikel')}}">
                @error('gambarArtikel')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kontentarea" class="form-label">Kontent Artikel</label>
                <textarea name="kontenArtikel" id="kontentarea" class="form-control @error('kontenArtikel') is-invalid @enderror" cols="30" rows="10" required autofocus value="{{ old('kontenArtikel')}}"></textarea>
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