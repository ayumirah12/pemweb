<?php

namespace App\Http\Controllers;

class HalamanController extends Controller
{
    // Nama singkat yang tampil di header, footer, dan judul Home.
    private string $nama = 'Mirah Dhinata';

    // Username Instagram (tanpa @). Dipakai di Home, Data Diri, dan footer.
    private string $instagram = '0nlymirah';

    // Foto profil (file ada di public/images). Ganti file-nya atau ubah nama file di sini.
    private string $fotoProfil = 'images/profil.jpg';

    // GANTI daftar hobi ini dengan hobi kamu. Tambah atau hapus baris sesukamu.
    // 'gambar' = foto yang tampil di bawah hobi (path relatif terhadap public/images/).
    // Untuk logo game asli: taruh file logo (png/jpg) di public/images/hobi/ lalu ganti nama file-nya di sini.
    private function daftarHobi(): array
    {
        return [
            [
                'nama'   => 'Healing',
                'isi'    => 'Menjelajah alam dan mendaki gunung untuk menenangkan pikiran.',
                'gambar' => [
                    ['file' => 'galeri/mendaki/foto1.jpg', 'judul' => 'Menatap pegunungan'],
                    ['file' => 'galeri/mendaki/foto3.jpg', 'judul' => 'Di puncak Batur'],
                    ['file' => 'galeri/mendaki/foto2.jpg', 'judul' => 'Papan Mt. Batur 1717 mdpl'],
                ],
            ],
            [
                'nama'   => 'Gaming',
                'isi'    => 'Bermain Mobile Legends dan Free Fire untuk bersantai dan melepas penat.',
                'gambar' => [
                    ['file' => 'hobi/mobile-legends.png', 'judul' => 'Mobile Legends', 'logo' => true],
                    ['file' => 'hobi/free-fire.png',      'judul' => 'Free Fire',      'logo' => true],
                ],
            ],
        ];
    }

    // Album galeri. File foto ada di public/images/galeri/<nama-folder>/
    // Tambah foto: taruh file di folder album, lalu tambah satu baris ['file' => ..., 'judul' => ...].
    private function daftarAlbum(): array
    {
        return [
            [
                'id'    => 'mendaki',
                'judul' => 'Mendaki',
                'ket'   => 'Langit biru, jalur tanah, dan pemandangan dari Gunung Batur.',
                'foto'  => [
                    ['file' => 'mendaki/foto1.jpg', 'judul' => 'Menatap pegunungan'],
                    ['file' => 'mendaki/foto2.jpg', 'judul' => 'Papan Mt. Batur 1717 mdpl'],
                    ['file' => 'mendaki/foto3.jpg', 'judul' => 'Di puncak Batur'],
                    ['file' => 'mendaki/foto4.jpg', 'judul' => 'Langit sebelum matahari terbit'],
                ],
            ],
            [
                'id'    => 'nongkrong',
                'judul' => 'Nongkrong',
                'ket'   => 'Kopi, obrolan panjang, dan tempat favorit.',
                'foto'  => [
                    ['file' => 'nongkrong/foto1.jpg', 'judul' => 'Pastry, matcha, dan photobooth'],
                ],
            ],
            [
                'id'    => 'teman',
                'judul' => 'Me n My Friends',
                'ket'   => 'Orang-orang yang bikin hari-hariku lebih seru.',
                'foto'  => [
                    ['file' => 'teman/foto1.jpg', 'judul' => 'Mirror selfie bertiga'],
                    ['file' => 'teman/foto2.jpg', 'judul' => 'Mirror selfie berempat'],
                ],
            ],
        ];
    }

    // ===== HALAMAN 1: HOME (memakai VARIABEL) =====
    public function home()
    {
        $nama       = $this->nama;
        $instagram  = $this->instagram;
        $fotoProfil = $this->fotoProfil;
        $peran      = 'Mahasiswa INSTIKI';
        $sapaan     = 'Selamat datang di website pribadi saya!';
        $deskripsi  = 'Saya sedang belajar membuat website dengan Laravel 12. Silakan lihat data diri dan galeri foto saya lewat menu di atas.';
        $hobi       = $this->daftarHobi();
        $album      = $this->daftarAlbum();

        return view('home', compact('nama', 'instagram', 'fotoProfil', 'peran', 'sapaan', 'deskripsi', 'hobi', 'album'));
    }

    // ===== HALAMAN 2: DATA DIRI (memakai LOOPING WHILE) + HOBI =====
    public function dataDiri()
    {
        $nama      = $this->nama;
        $instagram = $this->instagram;
        $hobi      = $this->daftarHobi();

        $dataDiri = [
            ['label' => 'Nama lengkap', 'isi' => 'I Gusti Ayu Mirah Dhinata Sukadana'],
            ['label' => 'Tempat, tanggal lahir', 'isi' => 'Denpasar, 29 November 2007'],
            ['label' => 'Alamat', 'isi' => 'Jln. Gunung Batu No. 74'],
            ['label' => 'Pendidikan', 'isi' => 'Institut Bisnis dan Teknologi Indonesia (INSTIKI)'],
            ['label' => 'Hobi', 'isi' => implode(', ', array_column($hobi, 'nama'))],
            ['label' => 'Email', 'isi' => 'mirahhsukadana@gmail.com'],
            ['label' => 'Instagram', 'isi' => '@' . $instagram, 'link' => 'https://www.instagram.com/' . $instagram . '/'],
        ];

        return view('data-diri', compact('nama', 'instagram', 'dataDiri', 'hobi'));
    }

    // ===== HALAMAN 3: GALERI FOTO (dipisah per album) =====
    public function galeri()
    {
        $nama      = $this->nama;
        $instagram = $this->instagram;
        $album     = $this->daftarAlbum();

        return view('galeri', compact('nama', 'instagram', 'album'));
    }
}
