Selamat datang di dokumentasi pengguna untuk **Sistem Absensi Online**. Aplikasi ini dirancang untuk mencatat kehadiran karyawan/mahasiswa secara real-time dengan antarmuka yang sederhana dan fitur reset data otomatis harian.
## 📋 Persiapan Sistem (Instalasi)
Sebelum menggunakan aplikasi, pastikan lingkungan server Localhost(laragon/xampp) sudah siap.

### 1. Konfigurasi Database
Aplikasi ini membutuhkan database MySQL agar dapat berjalan.
1. Buka mysql melalui terminal atau database localhost masing-masing
2. Buat database baru dengan nama: `absensi_db`.
3. Jalankan query SQL berikut pada tab **SQL** untuk membuat tabel yang diperlukan:

```sql
CREATE TABLE data_absensi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    keterangan TEXT,
    waktu_masuk TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

- Pindahkan proyek folder ke ...\laragon\www (menyesuaikan)
- akses di browser dengan mengetik: http://absensiOnline.test

- Pastikan jam digital di bagian atas menunjukkan waktu yang benar.
- Nama Lengkap: Masukkan nama Anda (Wajib diisi). Jika dikosongkan, sistem akan menolak.
- Status Kehadiran: Pilih salah satu opsi:
    Hadir
    Izin
    Sakit
    Remote / WFH
    Keterangan (Opsional).
- Klik tombol "Kirim Absensi".

- Kirim Absensi
- Pesan "Absensi berhasil dicatat!" akan muncul di bagian atas form.
- Data akan langsung muncul pada tabel Daftar Kehadiran Hari Ini di bagian bawah halaman.
- Tabel hanya menampilkan 10 data kehadiran terakhir.

Note: Jika tanggal hari ini berbeda dengan tanggal terakhir akses, sistem akan menghapus seluruh data absensi di database secara otomatis. Halaman akan melakukan reload otomatis untuk memastikan tabel kosong dan siap untuk hari yang baru.