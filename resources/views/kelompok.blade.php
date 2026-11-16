{{-- VIEW KELOMPOK: edit tampilan di file ini. Nama kelompok & daftar anggota diedit di HalamanController.php ($kelompok dan daftarAnggota) --}}
@extends('layouts.app')

@section('judul', 'Kelompok ' . $kelompok)

@section('konten')
<div class="lebar halaman">
    <div class="panel kotak">
        <h1>Kelompok {{ $kelompok }}</h1>
        <p class="lead">{{ $deskripsi }}</p>
    </div>

    <h2 class="judul-bagian" id="anggota">Anggota</h2>
    <div class="hobi-grid">
        @foreach ($anggota as $a)
            <article class="panel hobi anggota">
                <span class="avatar" aria-hidden="true">{{ strtoupper(substr($a['nama'], 0, 1)) }}</span>
                <h3>{{ $a['nama'] }}</h3>
                <p>{{ $a['peran'] }}</p>
                @if (!empty($a['ig']))
                    <p><a href="https://www.instagram.com/{{ $a['ig'] }}/" target="_blank" rel="noopener">&#64;{{ $a['ig'] }}</a></p>
                @endif
            </article>
        @endforeach
    </div>
</div>
@endsection
