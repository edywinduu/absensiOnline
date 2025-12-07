<?php
include 'koneksi.php';

if (isset($_POST['action']) && $_POST['action'] === 'clear') {
    $sql = "DELETE FROM data_absensi";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data telah dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>