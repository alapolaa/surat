<?php
include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];

    $status_tanah = $_POST['status_tanah'] ?? null;
    $luas_tanah = $_POST['luas_tanah'] ?? null;
    $letak_tanah = $_POST['letak_tanah'] ?? null;
    $status_kepemilikan = $_POST['status_kepemilikan'] ?? null;
    $batas_utara = $_POST['batas_utara'] ?? null;
    $batas_selatan = $_POST['batas_selatan'] ?? null;
    $batas_timur = $_POST['batas_timur'] ?? null;
    $batas_barat = $_POST['batas_barat'] ?? null;

    // Upload file pendukung (KTP/KK)
    $file_pendukung = null;
    if (!empty($_FILES['file_pendukung']['name'])) {
        $file_pendukung = 'uploads/' . basename($_FILES['file_pendukung']['name']);
        move_uploaded_file($_FILES['file_pendukung']['tmp_name'], $file_pendukung);
    }

    // Upload bukti kepemilikan tanah (Sertifikat)
    $bukti_kepemilikan = null;
    if (!empty($_FILES['bukti_kepemilikan']['name'])) {
        $bukti_kepemilikan = 'uploads/' . basename($_FILES['bukti_kepemilikan']['name']);
        move_uploaded_file($_FILES['bukti_kepemilikan']['tmp_name'], $bukti_kepemilikan);
    }

    // Simpan ke database
    $query = "INSERT INTO detail_surat 
        (nama_lengkap, nik, alamat, file_pendukung, status_tanah, luas_tanah, letak_tanah, status_kepemilikan, bukti_kepemilikan, batas_utara, batas_selatan, batas_timur, batas_barat) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssdsssssss", $nama_lengkap, $nik, $alamat, $file_pendukung, $status_tanah, $luas_tanah, $letak_tanah, $status_kepemilikan, $bukti_kepemilikan, $batas_utara, $batas_selatan, $batas_timur, $batas_barat);

    if ($stmt->execute()) {
        echo "Pengajuan berhasil dikirim.";
    } else {
        echo "Gagal mengirim pengajuan: " . $conn->error;
    }
}
