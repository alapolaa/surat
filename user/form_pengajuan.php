<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengguna = 1;
    $jenis_surat = $_POST['jenis_surat'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : null;
    $keperluan = isset($_POST['keperluan']) ? $_POST['keperluan'] : null;
    $status_pernikahan = isset($_POST['status_pernikahan']) ? $_POST['status_pernikahan'] : null;
    $jenis_usaha = isset($_POST['jenis_usaha']) ? $_POST['jenis_usaha'] : null;
    $status_tanah = isset($_POST['status_tanah']) ? $_POST['status_tanah'] : null;
    $file_pendukung = null;


    $query1 = "INSERT INTO pengajuan_surat (id_pengguna, jenis_surat) VALUES (?, ?)";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param("is", $id_pengguna, $jenis_surat);

    if ($stmt1->execute()) {
        $id_pengajuan = $conn->insert_id;


        $query2 = "INSERT INTO detail_surat 
            (id_pengajuan, nama_lengkap, tempat_lahir, tanggal_lahir, nik, alamat, agama, pekerjaan, keperluan, status_pernikahan, jenis_usaha, status_tanah, file_pendukung) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("issssssssssss", $id_pengajuan, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $nik, $alamat, $agama, $pekerjaan, $keperluan, $status_pernikahan, $jenis_usaha, $status_tanah, $file_pendukung);

        if ($stmt2->execute()) {
            echo "<script>alert('Pengajuan berhasil!'); window.location='../index.php';</script>";
        } else {
            die("Error detail_surat: " . $stmt2->error);
        }
    } else {
        die("Error pengajuan_surat: " . $stmt1->error);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Surat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function showForm() {
            var jenisSurat = document.getElementById("jenis_surat").value;
            var formFields = document.getElementById("form_fields");

            var html = "";
            if (jenisSurat) {
                html += `<label>Nama Lengkap</label><input type="text" name="nama_lengkap" class="form-control" required>`;
                html += `<label>Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" required>`;
                html += `<label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" required>`;
                html += `<label>NIK</label><input type="text" name="nik" class="form-control" required>`;
                html += `<label>Alamat</label><textarea name="alamat" class="form-control" required></textarea>`;
                html += `<label>Agama</label><input type="text" name="agama" class="form-control" required>`;
                html += `<label>Pekerjaan</label><input type="text" name="pekerjaan" class="form-control">`;
                html += `<label>Keperluan</label><textarea name="keperluan" class="form-control" required></textarea>`;

                if (jenisSurat === "belum_menikah") {
                    html += `<label>Status Pernikahan</label>
                            <select name="status_pernikahan" class="form-control">
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                            </select>`;
                }

                if (jenisSurat === "usaha") {
                    html += `<label>Jenis Usaha</label><input type="text" name="jenis_usaha" class="form-control" required>`;
                }

                if (jenisSurat === "tanah") {
                    html += `<label>Status Tanah</label><input type="text" name="status_tanah" class="form-control" required>`;
                }
            }
            formFields.innerHTML = html;
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2>Form Pengajuan Surat</h2>
        <form method="POST">
            <label>Pilih Jenis Surat</label>
            <select name="jenis_surat" id="jenis_surat" class="form-control" onchange="showForm()" required>
                <option value="">-- Pilih --</option>
                <option value="Domisili">Surat Domisili</option>
                <option value="Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                <option value="Usaha">Surat Usaha</option>
                <option value="Belum Menikah">Surat Belum Menikah</option>
                <option value="Tanah">Surat Tanah</option>
            </select>
            <div id="form_fields" class="mt-3"></div>
            <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
        </form>
    </div>
</body>

</html>