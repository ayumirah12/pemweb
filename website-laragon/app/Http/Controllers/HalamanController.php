<?php

namespace App\Http\Controllers;

class HalamanController extends Controller
{
    // GANTI "Nama Kamu" dengan nama kamu. Dipakai di header, footer, dan semua halaman.
    private string $nama = 'Nama Kamu';

    // ===== HALAMAN 1: HOME (memakai VARIABEL) =====
    public function home()
    {
        $nama      = $this->nama;
        $peran     = 'Pelajar Pemrograman Web';
        $sapaan    = 'Selamat datang di website pribadi saya!';
        $deskripsi = 'Saya sedang belajar membuat website dengan Laravel 12. Silakan lihat data diri dan galeri foto saya lewat menu di atas.';

        return view('home', compact('nama', 'peran', 'sapaan', 'deskripsi'));
    }

    // ===== HALAMAN 2: DATA DIRI (memakai LOOPING WHILE) =====
    public function dataDiri()
    {
        $nama = $this->nama;

        $dataDiri = [
            ['label' => 'Nama lengkap', 'isi' => 'Nama Kamu'],
            ['label' => 'Tempat, tanggal lahir', 'isi' => 'Kota, 1 Januari 2005'],
            ['label' => 'Alamat', 'isi' => 'Jalan Contoh No. 1, Kota'],
            ['label' => 'Pendidikan', 'isi' => 'Nama Sekolah / Kampus Kamu'],
            ['label' => 'Hobi', 'isi' => 'Coding, membaca, olahraga'],
            ['label' => 'Email', 'isi' => 'emailkamu@example.com'],
        ];

        return view('data-diri', compact('nama', 'dataDiri'));
    }

    // ===== HALAMAN 3: GALERI FOTO =====
    public function galeri()
    {
        $nama = $this->nama;

        // File foto ada di public/images/galeri/
        $foto = [
            ['file' => 'foto1.svg', 'judul' => 'Foto 1'],
            ['file' => 'foto2.svg', 'judul' => 'Foto 2'],
            ['file' => 'foto3.svg', 'judul' => 'Foto 3'],
            ['file' => 'foto4.svg', 'judul' => 'Foto 4'],
            ['file' => 'foto5.svg', 'judul' => 'Foto 5'],
            ['file' => 'foto6.svg', 'judul' => 'Foto 6'],
        ];

        return view('galeri', compact('nama', 'foto'));
    }
}
