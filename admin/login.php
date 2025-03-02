<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM perangkat_desa WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Langsung bandingkan kata sandi
        if ($password == $row['password']) {
            $_SESSION['email'] = $email;
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Email tidak ditemukan.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Perangkat Desa</title>
</head>

<body>
    <h2>Login Perangkat Desa</h2>
    <?php if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>