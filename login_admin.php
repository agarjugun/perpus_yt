<?php
session_start();
include "loginSystem/connect.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: DashboardPetugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: DashboardAdmin/index.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


// Query to check user credentials
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = $connect->query($query);

if (mysqli_num_rows($result) === 1) {
  $_SESSION['username'] = true;
  $rows = mysqli_fetch_assoc($result);
  if ($rows['sebagai'] == 'petugas') {
    $_SESSION['sebagai'] = $rows['sebagai'];
    $_SESSION['nama'] = $rows['nama'];
    // $_SESSION['id'] = $rows['password'];
    return header("Location: DashboardPetugas/index.php");

    if (isset($_SESSION['username'])) {
      header("Location: DashboardPetugas/index.php");
      exit;
    }
  } elseif ($rows['sebagai'] == 'admin') {
    $_SESSION['sebagai'] = $rows['sebagai'];
    $_SESSION['nama'] = $rows['nama'];
    // $_SESSION['id'] = $rows['password'];
    return header("Location: DashboardAdmin/index.php");


    if (isset($_SESSION['username'])) {
      header("Location: DashboardAdmin/index.php");
      exit;
    }
  }

} else {
    // Login failed
    echo "Invalid username or password";
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
    <form action="" method="post" class="row g-3 p-4">
            <h1>Login Siswa</h1>
            <div class="inputbox">
                <ion-icon name="card-outline"></ion-icon>
                <input type="text" name="username" required>
                <label for="username">Username</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" name="btn-login">Log in</button>
            <div class="register">
                <p>Masuk ke <a href="login.php">Siswa</a></p>
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
