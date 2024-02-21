<?php
if (isset($_SESSION['sebagai'])) {
    if ($_SESSION['sebagai'] == 'petugas') {
      header("Location: DashboardPetugas/index.php");
      exit;
    } elseif ($_SESSION['sebagai'] == 'admin') {
      header("Location: DashboardAdmin/index.php");
      exit;
    }
  }
?>