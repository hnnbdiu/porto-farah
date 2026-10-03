# Panduan Pengaturan Server dan Portofolio

Berikut adalah panduan singkat mengenai perubahan konfigurasi di sisi server (PHP & Nginx) agar fitur unggah banyak gambar di galeri berfungsi dengan baik tanpa terpotong (error file too large).

## 1. Konfigurasi PHP (`php.ini`)

Anda perlu mengedit file `php.ini`. Lokasinya bergantung pada sistem operasi dan web server yang digunakan (misalnya `/etc/php/8.2/fpm/php.ini` di Ubuntu atau `C:\xampp\php\php.ini` di Windows/XAMPP).

Temukan dan ubah nilai-nilai berikut:

```ini
; Meningkatkan batas ukuran maksimal 1 file yang diunggah
upload_max_filesize = 12M

; Meningkatkan batas total ukuran dari seluruh form (termasuk banyak gambar)
post_max_size = 64M

; Meningkatkan batas jumlah maksimal file yang bisa diunggah sekaligus
max_file_uploads = 25

; Opsional: meningkatkan batas memori untuk pemrosesan gambar oleh Intervention/GD
memory_limit = 256M
```

> **Catatan:** Pastikan extension `gd` sudah aktif. Cari baris `extension=gd` (atau `extension=php_gd2.dll` di Windows) dan hilangkan tanda titik koma (`;`) di depannya jika masih ada.

Setelah mengubah file `php.ini`, **restart service PHP/Apache/Nginx**.
- Di Windows/XAMPP: Stop lalu Start modul Apache dari Control Panel.
- Di Ubuntu/Linux: `sudo systemctl restart php8.2-fpm`

## 2. Konfigurasi Nginx (Jika menggunakan Nginx)

Nginx memiliki batasan ukuran unggahan sendiri (`client_max_body_size`), yang secara default bernilai `1M`. Anda harus menyelaraskannya dengan `post_max_size` milik PHP.

Buka file konfigurasi Nginx (biasanya di `/etc/nginx/nginx.conf` atau `/etc/nginx/sites-available/domainanda.com`). Tambahkan atau ubah pengaturan ini di dalam blok `http { ... }` atau `server { ... }`:

```nginx
server {
    ...
    # Menyelaraskan dengan post_max_size di php.ini
    client_max_body_size 64M;
    ...
}
```

Setelah mengubah, periksa sintaks Nginx dan restart:
```bash
sudo nginx -t
sudo systemctl reload nginx
```

## 3. Fitur Tambahan
Website ini telah diperbarui:
1. **Perbaikan Teks & Profil:** Mengubah seluruh teks perkenalan dan identitas.
2. **Perbaikan Menu Admin:** Menambahkan fungsionalitas admin yang lengkap tanpa mengubah desain asli (kecuali penambahan menu terkait).
3. **Perbaikan Gambar Pencapaian/Proyek:** Menambahkan logika penampilan gambar dan gambar placeholder fallback.
4. **Fitur Galeri Karya:** Penambahan galeri berkonsep *masonry grid* menggunakan `intervention/image` untuk mengecilkan ukuran dimensi dan mengubah gambar menjadi format `.webp` agar website tetap cepat.
