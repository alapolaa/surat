<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id_pengajuan = $_GET['id'];

    // Update status menjadi 'Ditolak'
    $query = "UPDATE pengajuan_surat SET status = 'Ditolak' WHERE id = $id_pengajuan";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Pengajuan surat ditolak!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Gagal memperbarui status: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
