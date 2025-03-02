<?php
session_start();
include 'config/config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];

// Ambil data pengguna dari database
$query_user = "SELECT * FROM pengguna WHERE id = '$id_pengguna'";
$result_user = $conn->query($query_user);
$user = $result_user->fetch_assoc();

// Ambil data pengajuan surat pengguna
$query_surat = "SELECT * FROM pengajuan_surat WHERE id_pengguna = '$id_pengguna' ORDER BY tanggal_pengajuan DESC";
$result_surat = $conn->query($query_surat);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Warga</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Selamat Datang, <?= $user['nama']; ?>!</h2>
        <p>Email: <?= $user['email']; ?></p>
        <p>Nomor HP: <?= $user['no_hp']; ?></p>
        <hr>

        <h3>Status Pengajuan Surat</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan Penolakan</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_surat->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['jenis_surat']; ?></td>
                        <td>
                            <span class="badge bg-<?= ($row['status'] == 'Siap Diambil') ? 'success' : (($row['status'] == 'Ditolak') ? 'danger' : 'warning'); ?>">
                                <?= $row['status']; ?>
                            </span>
                        </td>
                        <td><?= $row['tanggal_pengajuan']; ?></td>
                        <td><?= $row['tanggal_selesai'] ? $row['tanggal_selesai'] : '-'; ?></td>
                        <td><?= ($row['status'] == 'Ditolak' && $row['alasan_penolakan']) ? $row['alasan_penolakan'] : '-'; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-4">
        <a href="user/form_pengajuan.php" class="btn btn-primary">Ajukan Surat Baru</a>
        <a href="login.php" class="btn btn-danger">Logout</a>
    </div>
</body>

</html>