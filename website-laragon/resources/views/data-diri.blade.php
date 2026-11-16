@extends('layouts.app')

@section('judul', 'Data Diri')

@section('konten')
<h1>Data Diri</h1>
<p class="lead">Berikut data diri saya, ditampilkan dengan looping while.</p>

@php
    $i = 0; // nomor awal
@endphp

<table class="tabel">
    <tbody>
        @while ($i < count($dataDiri))
            <tr>
                <th>{{ $dataDiri[$i]['label'] }}</th>
                <td>{{ $dataDiri[$i]['isi'] }}</td>
            </tr>
            @php
                $i++; // naikkan nomor, kalau tidak looping tidak akan berhenti
            @endphp
        @endwhile
    </tbody>
</table>
@endsection
