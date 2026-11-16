@extends('layouts.app')

@section('judul', 'Galeri')

@section('konten')
<h1>Galeri Foto</h1>
<p class="lead">Kumpulan foto saya.</p>

<div class="grid">
    @foreach ($foto as $f)
        <figure>
            <img src="{{ asset('images/galeri/' . $f['file']) }}" alt="{{ $f['judul'] }}" loading="lazy">
            <figcaption>{{ $f['judul'] }}</figcaption>
        </figure>
    @endforeach
</div>
@endsection
