<?php
include '../config/config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM detail_surat WHERE id_pengajuan='$id'");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Cetak Surat</title>
</head>

<body onload="window.print();">
    <h2>Surat <?= $data['jenis_surat']; ?></h2>
    <p>Nama: <?= $data['nama_lengkap']; ?></p>
    <p>NIK: <?= $data['nik']; ?></p>
    <p>Alamat: <?= $data['alamat']; ?></p>
    <p>Keperluan: <?= $data['keperluan']; ?></p>
    <p>Tanggal: <?= date('d-m-Y'); ?></p>
</body>

</html>