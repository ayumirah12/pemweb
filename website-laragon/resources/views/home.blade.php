@extends('layouts.app')

@section('judul', 'Home')

@section('konten')
<section class="hero">
    <img class="profil" src="{{ asset('images/profil.svg') }}" alt="Foto {{ $nama }}">
    <div>
        <p class="peran">{{ $peran }}</p>
        <h1>Halo, saya {{ $nama }}</h1>
        <p class="lead">{{ $sapaan }}</p>
        <p>{{ $deskripsi }}</p>
        <p class="aksi">
            <a class="tombol" href="{{ route('data-diri') }}">Lihat data diri</a>
            <a class="tombol kosong" href="{{ route('galeri') }}">Buka galeri</a>
        </p>
    </div>
</section>
@endsection
