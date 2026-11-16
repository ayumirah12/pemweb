// Tab klik dengan animasi: klik tombol [data-tab-target], panel [data-tab-panel] yang sesuai tampil.
// Setiap grup ditandai dengan atribut data-tabs. Panah keyboard juga bisa dipakai.
(function () {
    document.querySelectorAll('[data-tabs]').forEach(function (grup) {
        var tombol = Array.prototype.slice.call(grup.querySelectorAll('[data-tab-target]'));
        var panel = Array.prototype.slice.call(grup.querySelectorAll('[data-tab-panel]'));
        if (!tombol.length) return;

        function pilih(btn, fokus) {
            tombol.forEach(function (b) {
                var aktif = (b === btn);
                b.classList.toggle('aktif', aktif);
                b.setAttribute('aria-selected', aktif ? 'true' : 'false');
                b.tabIndex = aktif ? 0 : -1;
            });
            panel.forEach(function (p) {
                var tampil = (p.id === btn.dataset.tabTarget);
                p.classList.remove('masuk');
                p.hidden = !tampil;
                if (tampil) {
                    void p.offsetWidth;      // paksa browser mengulang animasi
                    p.classList.add('masuk');
                }
            });
            if (fokus) btn.focus();
        }

        tombol.forEach(function (b, i) {
            b.addEventListener('click', function () { pilih(b); });
            b.addEventListener('keydown', function (e) {
                var j = null;
                if (e.key === 'ArrowDown' || e.key === 'ArrowRight') j = (i + 1) % tombol.length;
                else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') j = (i - 1 + tombol.length) % tombol.length;
                if (j !== null) { e.preventDefault(); pilih(tombol[j], true); }
            });
        });
    });
})();
