<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('judul') | {{ $nama }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Header dan footer dipisah di folder partials --}}
    @include('partials.header')

    <main class="isi">
        @yield('konten')
    </main>

    @include('partials.footer')
</body>
</html>
