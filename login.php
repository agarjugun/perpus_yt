<?php
session_start();
include "loginSystem/connect.php";
if (isset($_POST['nisn']) && isset($_POST['nama'])) {
  // Get user input
  $nisn = $_POST['nisn'];
  $nama = $_POST['nama'];

// Query to check user credentials
$query = "SELECT * FROM member WHERE nisn='$nisn' AND nama='$nama'";
$result = $connect->query($query);

if ($result->num_rows == 1) {
    // Login successful
    $_SESSION['nama'] = $nama;
    $_SESSION['nisn'] = $nisn;
    header("Location: DashboardMember/dashboard.php"); // Redirect to dashboard or any other page
} else {
    // Login failed
    echo "<script>alert('nis atau nama Anda salah. Silahkan coba lagi!')</script>";
}
}
$connect->close();
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Readbooks.com</title>
  <link rel="icon" href="assets/iconblack.png" type="image/png">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script><link rel="stylesheet" href="css/style.css">

</head>
<style>
    body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-image: url(assets/perpus.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-attachment: fixed;
}
</style>
<body>
<!-- partial:index.partial.html -->
<body>
    <section>
    <form action="" method="post" class="row g-3 p-4 needs-validation">
            <h1>Login Siswa</h1>
            <div class="inputbox">
                <ion-icon name="card-outline"></ion-icon>
                <input type="text" name="nisn" required>
                <label for="nisn">NISN</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="text" name="nama" required>
                <label for="nama">nama</label>
            </div>
            <button type="submit" name="submit">Log in</button>
            <div class="register">
                <p>Belum punya akun? <a href="daftar.php">Daftar</a></p>
            </div>
            <div class="register">
                <p>Masuk ke <a href="login_admin.php">Admin</a></p>
            </div>
            <div class="register">
                <p>Kembali ke <a href="index.php">Home</a></p>
            </div>
        </form>
    </section>
</body>
<!-- partial -->
  
</body>
</html>
