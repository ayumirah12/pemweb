@php
    // 3 menu. Tiap menu mengarah ke nama route di routes/web.php
    $menu = [
        ['label' => 'Home',      'route' => 'home'],
        ['label' => 'Data Diri', 'route' => 'data-diri'],
        ['label' => 'Galeri',    'route' => 'galeri'],
    ];
@endphp
<header class="header">
    <div class="lebar bar">
        <a class="logo" href="{{ route('home') }}">{{ $nama }}</a>
        <nav aria-label="Menu utama">
            <ul>
                @foreach ($menu as $m)
                    <li>
                        <a href="{{ route($m['route']) }}" @class(['aktif' => request()->routeIs($m['route'])])>{{ $m['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
