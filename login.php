<?php
include 'config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $query = "SELECT * FROM pengguna WHERE nik='$nik'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password == $user['password']) { // Pastikan pakai password hashing (bcrypt)
            $_SESSION['id_pengguna'] = $user['id']; // Ubah ke `id_pengguna` agar konsisten
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = 'warga'; // Default sebagai warga

            // Arahkan ke index.php setelah login berhasil
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('NIK tidak ditemukan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Login</h2>
        <form method="POST">
            <label>NIK:</label>
            <input type="text" name="nik" class="form-control" required>

            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>

            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
        <p>Perangkat Desa? <a href="admin/login.php">Login </a></p>
    </div>
</body>

</html>