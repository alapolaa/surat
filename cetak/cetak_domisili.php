<?php
include '../config/config.php';

if (isset($_GET['id'])) {
    $id_pengajuan = $_GET['id'];

    // Ambil data detail surat
    $stmt = $conn->prepare("SELECT ds.*, ps.jenis_surat FROM detail_surat ds JOIN pengajuan_surat ps ON ds.id_pengajuan = ps.id WHERE ds.id_pengajuan = ?");
    $stmt->bind_param("i", $id_pengajuan);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data) {
        // Tampilkan template surat domisili
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Surat Domisili</title>
        </head>

        <body>
            <h1>Surat Keterangan Domisili</h1>
            <p>Nama: <?= $data['nama_lengkap']; ?></p>
            <p>Alamat: <?= $data['alamat']; ?></p>
            <script>
                window.print();
            </script>
        </body>

        </html>
<?php
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID pengajuan tidak valid.";
}
?>