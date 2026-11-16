{{-- VIEW GALERI: edit tampilan di file ini. Daftar album & foto diedit di HalamanController.php (method galeri) --}}
@extends('layouts.app')

@section('judul', 'Galeri')

@section('konten')
<div class="lebar halaman">
    <div class="panel kotak">
        <h1>Galeri Foto</h1>
        <p class="lead">Klik foto untuk memperbesar dan melihatnya lebih dekat.</p>
    </div>

    {{-- Pintasan ke tiap album (looping) --}}
    <nav class="album-nav" aria-label="Pilih album">
        @foreach ($album as $a)
            <a href="#{{ $a['id'] }}">{{ $a['judul'] }}</a>
        @endforeach
    </nav>

    {{-- Satu bagian per album (looping bersarang) --}}
    @foreach ($album as $a)
        <section class="panel album {{ $a['id'] }}" id="{{ $a['id'] }}">
            <h2>{{ $a['judul'] }}</h2>
            <p class="ket">{{ $a['ket'] }} ({{ count($a['foto']) }} foto)</p>

            <div class="galeri-grid">
                @foreach ($a['foto'] as $f)
                    <figure>
                        <button type="button" class="galeri-item"
                                data-src="{{ asset('images/galeri/' . $f['file']) }}"
                                data-judul="{{ $f['judul'] }}"
                                data-album="{{ $a['id'] }}"
                                data-album-judul="{{ $a['judul'] }}"
                                aria-label="Perbesar foto: {{ $f['judul'] }}">
                            <img src="{{ asset('images/galeri/' . $f['file']) }}" alt="{{ $f['judul'] }}" loading="lazy">
                            <span class="cap">{{ $f['judul'] }}</span>
                        </button>
                    </figure>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

{{-- Penampil foto (lightbox) dengan zoom --}}
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Penampil foto" hidden>
    <div class="lb-bar">
        <p class="lb-cap" aria-live="polite"></p>
        <div class="lb-alat">
            <button type="button" class="lb-min" aria-label="Perkecil">&minus;</button>
            <button type="button" class="lb-plus" aria-label="Perbesar">+</button>
            <button type="button" class="lb-reset">Reset</button>
            <button type="button" class="lb-tutup" aria-label="Tutup">&times;</button>
        </div>
    </div>
    <div class="lb-stage">
        <button type="button" class="lb-nav lb-prev" aria-label="Foto sebelumnya">&lsaquo;</button>
        <img class="lb-img" alt="" draggable="false">
        <button type="button" class="lb-nav lb-next" aria-label="Foto berikutnya">&rsaquo;</button>
    </div>
    <p class="lb-petunjuk">Klik foto atau tombol + dan &minus; untuk zoom. Geser foto saat diperbesar. Panah kiri dan kanan pindah foto, Esc menutup.</p>
</div>
@endsection

@push('skrip')
    <script src="{{ asset('js/galeri.js') }}" defer></script>
@endpush
