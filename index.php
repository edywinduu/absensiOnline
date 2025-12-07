<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $status = $_POST['status'];
    $keterangan = htmlspecialchars($_POST['keterangan']);

    // Menggunakan Prepared Statement untuk keamanan dari SQL Injection
    $stmt = $conn->prepare("INSERT INTO data_absensi (nama, status, keterangan) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $status, $keterangan);

    if ($stmt->execute()) {
        $pesan = "Absensi berhasil dicatat!";
    } else {
        $pesan = "Gagal mencatat absensi.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Online</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400" rel="stylesheet" type="text/css">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1><i class="fas fa-calendar-check"></i> Absensi Karyawan</h1>
    
    <div class="clock" id="jamDigital">--:--:--</div>

    <?php if (isset($pesan)) { echo "<div class='alert'><i class='fas fa-check-circle'></i> $pesan</div>"; } ?>

    <form action="" method="POST" onsubmit="return validasiForm()">
        <div class="form-group">
            <label for="nama"><i class="fas fa-user"></i> Nama Lengkap</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan nama Anda" required>
        </div>

        <div class="form-group">
            <label for="status"><i class="fas fa-list"></i> Status Kehadiran</label>
            <select name="status" id="status">
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Remote">Remote / WFH</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan"><i class="fas fa-comment"></i> Keterangan (Opsional)</label>
            <textarea name="keterangan" id="keterangan" rows="3" placeholder="Catatan tambahan..."></textarea>
        </div>

        <button type="submit" name="submit"><i class="fas fa-paper-plane"></i> Kirim Absensi</button>
    </form>

    <hr>

    <h3><i class="fas fa-table"></i> Daftar Kehadiran Hari Ini</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Waktu</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM data_absensi ORDER BY waktu_masuk DESC LIMIT 10";
            $result = $conn->query($sql);
            $no = 1;

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $no++ . "</td>
                        <td><i class='fas fa-user-circle'></i> " . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td><i class='fas fa-clock'></i> " . date('H:i, d M Y', strtotime($row['waktu_masuk'])) . "</td>
                        <td>" . htmlspecialchars($row['keterangan']) . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='no-data'>Belum ada data absensi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
<script src="script.js"></script>
</html>