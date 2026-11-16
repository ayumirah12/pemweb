// Penampil foto dengan zoom: klik foto, tombol +/-, scroll mouse, geser saat diperbesar.
// Tombol panah hanya berpindah di dalam album yang sedang dibuka.
(function () {
    var semua = Array.prototype.slice.call(document.querySelectorAll('.galeri-item'));
    var lb = document.getElementById('lightbox');
    if (!semua.length || !lb) return;

    var img = lb.querySelector('.lb-img');
    var cap = lb.querySelector('.lb-cap');
    var stage = lb.querySelector('.lb-stage');
    var MIN = 1, MAX = 4;
    var daftar = semua, idx = 0, scale = 1, tx = 0, ty = 0;
    var terakhir = null, seret = null, bergeser = false;

    function terapkan() {
        img.style.transform = 'translate(' + tx + 'px,' + ty + 'px) scale(' + scale + ')';
        stage.classList.toggle('zoom', scale > 1);
    }

    function setScale(s) {
        scale = Math.min(MAX, Math.max(MIN, s));
        if (scale === 1) { tx = 0; ty = 0; }
        terapkan();
    }

    function tampil(i) {
        idx = (i + daftar.length) % daftar.length;
        var b = daftar[idx];
        img.src = b.dataset.src;
        img.alt = b.dataset.judul;
        cap.textContent = b.dataset.albumJudul + ': ' + b.dataset.judul + ' (' + (idx + 1) + ' dari ' + daftar.length + ')';
        scale = 1; tx = 0; ty = 0;
        terapkan();
    }

    function buka(tombol) {
        terakhir = document.activeElement;
        daftar = semua.filter(function (b) { return b.dataset.album === tombol.dataset.album; });
        tampil(daftar.indexOf(tombol));
        lb.hidden = false;
        document.body.classList.add('kunci');
        lb.querySelector('.lb-tutup').focus();
    }

    function tutup() {
        lb.hidden = true;
        document.body.classList.remove('kunci');
        if (terakhir) terakhir.focus();
    }

    semua.forEach(function (b) {
        b.addEventListener('click', function () { buka(b); });
    });

    lb.querySelector('.lb-tutup').addEventListener('click', tutup);
    lb.querySelector('.lb-prev').addEventListener('click', function () { tampil(idx - 1); });
    lb.querySelector('.lb-next').addEventListener('click', function () { tampil(idx + 1); });
    lb.querySelector('.lb-plus').addEventListener('click', function () { setScale(scale + 0.5); });
    lb.querySelector('.lb-min').addEventListener('click', function () { setScale(scale - 0.5); });
    lb.querySelector('.lb-reset').addEventListener('click', function () { setScale(1); });

    // Klik area gelap di sekitar foto = tutup
    stage.addEventListener('click', function (e) { if (e.target === stage) tutup(); });

    // Scroll mouse = zoom
    stage.addEventListener('wheel', function (e) {
        e.preventDefault();
        setScale(scale + (e.deltaY < 0 ? 0.4 : -0.4));
    }, { passive: false });

    // Geser foto saat diperbesar
    img.addEventListener('pointerdown', function (e) {
        bergeser = false;
        if (scale <= 1) return;
        seret = { x: e.clientX - tx, y: e.clientY - ty, sx: e.clientX, sy: e.clientY };
        img.setPointerCapture(e.pointerId);
        stage.classList.add('seret');
    });
    img.addEventListener('pointermove', function (e) {
        if (!seret) return;
        tx = e.clientX - seret.x;
        ty = e.clientY - seret.y;
        if (Math.abs(e.clientX - seret.sx) + Math.abs(e.clientY - seret.sy) > 4) bergeser = true;
        terapkan();
    });
    function akhiri() { seret = null; stage.classList.remove('seret'); }
    img.addEventListener('pointerup', akhiri);
    img.addEventListener('pointercancel', akhiri);

    // Klik foto = zoom masuk/keluar (kecuali baru selesai menggeser)
    img.addEventListener('click', function () {
        if (bergeser) { bergeser = false; return; }
        setScale(scale > 1 ? 1 : 2.5);
    });

    // Keyboard
    document.addEventListener('keydown', function (e) {
        if (lb.hidden) return;
        if (e.key === 'Escape') { tutup(); }
        else if (e.key === 'ArrowLeft') { tampil(idx - 1); }
        else if (e.key === 'ArrowRight') { tampil(idx + 1); }
        else if (e.key === '+' || e.key === '=') { setScale(scale + 0.5); }
        else if (e.key === '-') { setScale(scale - 0.5); }
        else if (e.key === 'Tab') {
            var f = lb.querySelectorAll('button');
            var awal = f[0], akhir = f[f.length - 1];
            if (e.shiftKey && document.activeElement === awal) { e.preventDefault(); akhir.focus(); }
            else if (!e.shiftKey && document.activeElement === akhir) { e.preventDefault(); awal.focus(); }
        }
    });
})();
