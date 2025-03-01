<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id_pengajuan = $_GET['id'];
    $tanggal_selesai = date("Y-m-d H:i:s"); // Format TIMESTAMP

    // Update status menjadi 'Diproses' dan isi tanggal_selesai
    $query = "UPDATE pengajuan_surat SET status = 'Diproses', tanggal_selesai = '$tanggal_selesai' WHERE id = $id_pengajuan";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Surat berhasil diverifikasi!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Gagal verifikasi: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
