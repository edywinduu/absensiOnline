--Backend(
    ALGORITMA SimpanAbsensi:
    INPUT: Nama, Status, Keterangan

    VALIDASI:
    JIKA (Nama kosong) MAKA:
        TAMPILKAN Error "Nama wajib diisi"
        BERHENTI

    PROSES DATABASE:
    SIAPKAN Query (Prepared Statement)
    BIND parameter (mencegah SQL Injection)
    EKSEKUSI "INSERT INTO data_absensi..."

    HASIL:
    JIKA (Eksekusi Berhasil) MAKA:
        SET Pesan = "Absensi Berhasil"
        AMBIL data terbaru untuk tabel
    LAINNYA:
        SET Pesan = "Gagal Mencatat"
    
    TAMPILKAN Halaman Kembali
)


--Algortima Reset Data(
    ALGORITMA CekGantiHari:
    MULAI
    
    AMBIL tanggal_hari_ini (dari sistem komputer)
    AMBIL tanggal_disimpan (dari LocalStorage Browser)

    JIKA (tanggal_disimpan TIDAK SAMA DENGAN tanggal_hari_ini) MAKA:
        1. LAKUKAN Request ke Server (clear_data.php)
           -> Server menjalankan: "DELETE FROM data_absensi"
        2. PERBARUI tanggal_disimpan = tanggal_hari_ini
        3. Refresh Halaman (Reload)
    LAINNYA (Jika tanggal sama):
        1. Jangan lakukan apa-apa
        2. Lanjut tampilkan jam digital
    
    AKHIR JIKA
    
    SELESAI
)