<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT ds.*, ps.jenis_surat, p.nama, ps.status FROM detail_surat ds JOIN pengajuan_surat ps ON ds.id_pengajuan = ps.id JOIN pengguna p ON ps.id_pengguna = p.id WHERE ds.id_pengajuan = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Pengajuan surat tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pengajuan surat tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Detail Pengajuan Surat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Detail Pengajuan Surat</h2>
        <table class="table">
            <tr>
                <th>Nama Pemohon</th>
                <td><?= $row['nama']; ?></td>
            </tr>
            <tr>
                <th>Jenis Surat</th>
                <td><?= $row['jenis_surat']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= $row['status']; ?></td>
            </tr>
            <tr>
                <th>Nama Lengkap</th>
                <td><?= $row['nama_lengkap']; ?></td>
            </tr>
            <tr>
                <th>Tempat Lahir</th>
                <td><?= $row['tempat_lahir']; ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td><?= $row['tanggal_lahir']; ?></td>
            </tr>
            <tr>
                <th>NIK</th>
                <td><?= $row['nik']; ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?= $row['alamat']; ?></td>
            </tr>
            <tr>
                <th>Agama</th>
                <td><?= $row['agama']; ?></td>
            </tr>
            <tr>
                <th>Pekerjaan</th>
                <td><?= $row['pekerjaan'] ? $row['pekerjaan'] : '-'; ?></td>
            </tr>
            <tr>
                <th>Keperluan</th>
                <td><?= $row['keperluan']; ?></td>
            </tr>
            <tr>
                <th>File Pendukung</th>
                <td>
                    <?php if ($row['file_pendukung']) { ?>
                        <a href="../uploads/<?= $row['file_pendukung']; ?>" target="_blank">Lihat File</a>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>

            <?php if ($row['jenis_surat'] == "Belum Menikah") { ?>
                <tr>
                    <th>Status Pernikahan</th>
                    <td><?= $row['status_pernikahan']; ?></td>
                </tr>
            <?php } ?>

            <?php if ($row['jenis_surat'] == "Usaha") { ?>
                <tr>
                    <th>Jenis Usaha</th>
                    <td><?= $row['jenis_usaha']; ?></td>
                </tr>
            <?php } ?>

            <?php if ($row['jenis_surat'] == "Tanah") { ?>
                <tr>
                    <th>Status Tanah</th>
                    <td><?= $row['status_tanah']; ?></td>
                </tr>
                <tr>
                    <th>Luas Tanah (m²)</th>
                    <td><?= $row['luas_tanah']; ?></td>
                </tr>
                <tr>
                    <th>Letak Tanah</th>
                    <td><?= $row['letak_tanah']; ?></td>
                </tr>
                <tr>
                    <th>Status Kepemilikan</th>
                    <td><?= $row['status_kepemilikan']; ?></td>
                </tr>
                <tr>
                    <th>Bukti Kepemilikan</th>
                    <td>
                        <?php if ($row['bukti_kepemilikan']) { ?>
                            <a href="../uploads/<?= $row['bukti_kepemilikan']; ?>" target="_blank">Lihat File</a>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>Batas Utara</th>
                    <td><?= $row['batas_utara']; ?></td>
                </tr>
                <tr>
                    <th>Batas Selatan</th>
                    <td><?= $row['batas_selatan']; ?></td>
                </tr>
                <tr>
                    <th>Batas Timur</th>
                    <td><?= $row['batas_timur']; ?></td>
                </tr>
                <tr>
                    <th>Batas Barat</th>
                    <td><?= $row['batas_barat']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>