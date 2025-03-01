<?php
include '../config/config.php';
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['id_pengguna'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='../login.php';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengguna = $_SESSION['id_pengguna']; // Ambil ID pengguna dari session
    $jenis_surat = $_POST['jenis_surat'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $agama = $_POST['agama'];
    $pekerjaan = $_POST['pekerjaan'];
    $keperluan = $_POST['keperluan'];

    // Simpan ke tabel pengajuan_surat
    $query = "INSERT INTO pengajuan_surat (id_pengguna, jenis_surat, status) 
              VALUES ('$id_pengguna', '$jenis_surat', 'Menunggu Verifikasi')";

    if ($conn->query($query) === TRUE) {
        $id_pengajuan = $conn->insert_id;

        // Simpan ke tabel detail_surat
        $queryDetail = "INSERT INTO detail_surat (id_pengajuan, nama_lengkap, tempat_lahir, tanggal_lahir, nik, alamat, agama, pekerjaan, keperluan) 
                        VALUES ('$id_pengajuan', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$nik', '$alamat', '$agama', '$pekerjaan', '$keperluan')";

        if ($conn->query($queryDetail) === TRUE) {
            echo "<script>alert('Pengajuan berhasil!'); window.location.href='../index.php';</script>";
        } else {
            echo "Error saat menyimpan detail surat: " . $conn->error;
        }
    } else {
        echo "Error saat menyimpan pengajuan: " . $conn->error;
    }
}
