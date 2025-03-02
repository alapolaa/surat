<?php
include 'config/config.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO pengguna (nama, nik, tanggal_lahir, alamat, no_hp, email, password) VALUES ('$nama', '$nik', '$tanggal_lahir', '$alamat', '$no_hp', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrasi Pengguna</title>
</head>

<body>
    <h2>Registrasi Pengguna</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nama: <input type="text" name="nama" required><br><br>
        NIK: <input type="text" name="nik" required><br><br>
        Tanggal Lahir: <input type="date" name="tanggal_lahir" required><br><br>
        Alamat: <textarea name="alamat" required></textarea><br><br>
        No. HP: <input type="text" name="no_hp" required><br><br>
        Email: <input type="email" name="email"><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Daftar">
    </form>
</body>

</html>