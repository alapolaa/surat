<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $alasan_penolakan = trim($_POST['alasan_penolakan']);

    if (empty($alasan_penolakan)) {
        echo "<script>alert('Alasan penolakan harus diisi!'); window.history.back();</script>";
        exit;
    }

    // Update status pengajuan menjadi "Ditolak"
    $sql = "UPDATE pengajuan_surat SET status = 'Ditolak', alasan_penolakan = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $alasan_penolakan, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengajuan surat berhasil ditolak.'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Akses tidak sah.";
}

$conn->close();
