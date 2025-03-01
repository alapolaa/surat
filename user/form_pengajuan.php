<?php include '../config/config.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Form Pengajuan Surat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Pengajuan Surat</h2>
        <form action="../user/proses_pengajuan.php" method="POST">
            <label>Jenis Surat:</label>
            <select name="jenis_surat" class="form-control" required>
                <option value="Domisili">Surat Domisili</option>
                <option value="Tidak Mampu">Surat Tidak Mampu</option>
                <option value="Usaha">Surat Usaha</option>
                <option value="Belum Menikah">Surat Belum Menikah</option>
                <option value="Tanah">Surat Tanah</option>
            </select>

            <label>Nama Lengkap:</label>
            <input type="text" name="nama_lengkap" class="form-control" required>

            <label>NIK:</label>
            <input type="text" name="nik" class="form-control" required>

            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" required></textarea>

            <label>Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" class="form-control" required>

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>

            <label>Agama:</label>
            <input type="text" name="agama" class="form-control" required>

            <label>Pekerjaan:</label>
            <input type="text" name="pekerjaan" class="form-control">

            <label>Keperluan:</label>
            <textarea name="keperluan" class="form-control" required></textarea>

            <button type="submit" class="btn btn-primary mt-3">Kirim Pengajuan</button>
        </form>
    </div>
</body>

</html>