<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_SESSION['nisn'])) {
    header("Location: ../login.php");
    exit();
}

require "../config/config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION['nisn'];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM user where sebagai='petugas'");

// Peminjaman 
if(isset($_POST["pinjam"]) ) {
  
  if(pinjamBuku($_POST) > 0) {
    echo "<script>
    alert('Buku berhasil dipinjam');
    </script>";
  }else {
    echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
  }
  
}?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Readbooks.com</title>
    <link rel="icon" href="../assets/iconblack.png" type="image/png">
  </head>
  <style>
        body {
            display: flex;
            align-items: top;
            justify-content: top;
            background-image: url(../assets/perpus.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
  <body>

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
  <div class="dropdown" data-bs-theme="dark">
    <button class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="../assets/memberLogo.png" alt="memberLogo" width="40px">
    </button>
    <ul style="margin-right: -7rem;" class="dropdown-menu position-absolute mt-2 p-2">
        <li>
        <a class="dropdown-item text-center" href="#">
        <img src="../assets/memberLogo.png" alt="adminLogo" width="30px">
        </a>
        </li>
        <li>
        <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize"><?php echo $_SESSION['nama']; ?></span></a>
        <a class="dropdown-item text-center mb-2" href="#">Siswa</a>
        </li>
        <li>
        <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="logout.php">Logout <i class="fa-solid fa-right-to-bracket"></i></a>
        </li>
        </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Daftar Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="daftar_pinjam.php">Daftar Pinjam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php">History</a>
        </li>
      </ul>
    </div>
  </div>
</nav>    


<div class="container-xxl p-5 my-5">
<div class="">
    <div class="alert alert-dark" role="alert">Form Peminjaman Buku</div>
  <!-- Default box -->
<div class="card mb-auto">
      <h5 class="card-header">Data lengkap Buku</h5>
        <div class="card-body d-flex">
    <?php foreach ($query as $item) : ?>
        <div class="flex-shrink-0 me-3">
            <img src="../imgDB/<?= $item["cover"]; ?>" width="190px" height="250px" style="border-radius: 5px;">
        </div>
          <form action="" method="post" class="w-100">
            <div class="row">
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Id Buku</span>
            <input type="text" class="form-control" placeholder="id buku" aria-label="Username" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
            </div>
            </div>
            <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kategori</span>
            <input type="text" class="form-control" placeholder="kategori" aria-label="kategori" aria-describedby="basic-addon1" value="<?= $item["kategori"]; ?>" readonly>
            </div>
            </div>
            </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Judul</span>
            <input type="text" class="form-control" placeholder="judul" aria-label="judul" aria-describedby="basic-addon1" value="<?= $item["judul"]; ?>" readonly>
            </div>

            <div class="row">
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Pengarang</span>
            <input type="text" class="form-control" placeholder="pengarang" aria-label="pengarang" aria-describedby="basic-addon1" value="<?= $item["pengarang"]; ?>" readonly>
            </div>
            </div>
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Penerbit</span>
            <input type="text" class="form-control" placeholder="penerbit" aria-label="penerbit" aria-describedby="basic-addon1" value="<?= $item["penerbit"]; ?>" readonly>
            </div>
            </div>
            </div>

            <div class="row">
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
            <input type="date" class="form-control" placeholder="tahun_terbit" aria-label="tahun_terbit" aria-describedby="basic-addon1" value="<?= $item["thn_terbit"]; ?>" readonly>
            </div>
            </div>
            <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
            <input type="number" class="form-control" placeholder="jumlah halaman" aria-label="jumlah halaman" aria-describedby="basic-addon1" value="<?= $item["jml_halaman"]; ?>" readonly>
            </div>
            </div>
            </div>

          <div class="form-floating">
            <textarea class="form-control" placeholder="deskripsi singkat buku" id="floatingTextarea2" style="height: 100px" readonly><?= $item["deskripsi"]; ?></textarea>
            <label for="floatingTextarea2">Deskripsi Buku</label>
            </div>
        <?php endforeach; ?>
          </form>
        </div>

        <div class="card mt-4">
      <h5 class="card-header">Data lengkap Siswa</h5>
      <div class="card-body d-flex flex-wrap gap-4 justify-content-center">
        <p><img src="../assets/memberLogo.png" width="150px"></p>
        <form action="" method="post" class="w-100">
          <?php foreach ($dataSiswa as $item) : ?>

            <div class="row">
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nisn</span>
            <input type="number" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?= $item["nisn"]; ?>" readonly>
            </div>
            </div>
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nama</span>
            <input type="text" class="form-control" placeholder="nama" aria-label="nama" aria-describedby="basic-addon1" value="<?= $item["nama"]; ?>" readonly>
            </div>
            </div>
            </div>

            <div class="row">
              <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Kelas</span>
            <input type="text" class="form-control" placeholder="kelas" aria-label="kelas" aria-describedby="basic-addon1" value="<?= $item["kelas"]; ?>" readonly>
            </div>
            </div>
            <div class="col-6">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Jurusan</span>
            <input type="text" class="form-control" placeholder="jurusan" aria-label="jurusan" aria-describedby="basic-addon1" value="<?= $item["jurusan"]; ?>" readonly>
            </div>
            </div>
            </div>
            
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Alamat</span>
            <input type="text" class="form-control" placeholder="no tlp" aria-label="no tlp" aria-describedby="basic-addon1" value="<?= $item["alamat"]; ?>" readonly>
            </div>
        <?php endforeach; ?>
        </form>
       </div>
      </div>

      <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar sebelum meminjam buku! jika ada kesalahan data harap hubungi petugas.</div>
    
    <div class="card mt-4">
      <h5 class="card-header">Form Pinjam Buku</h5>
      <div class="card-body">
        <form action="" method="post">
          <!--Ambil data id buku-->
          <?php foreach ($query as $item) : ?>
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Id Buku</span>
            <input type="text" name="id_buku" class="form-control" placeholder="id buku" aria-label="id_buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
            </div>
          <?php endforeach; ?>
        <!-- Ambil data NISN user yang login-->
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nisn</span>
            <input type="number" name="nisn" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["nisn"]); ?>" readonly>
        </div>
    <!--Ambil data id admin-->
    <select name="id" class="form-select" aria-label="Default select example">
      <option selected>Pilih id Petugas</option>
      <?php foreach ($admin as $item) : ?>
      <option value="<?= $item["id"]; ?>"><?= $item["username"]; ?></option>
      <?php endforeach; 
            $sekarang	=date("Y-m-d");
        ?>
    </select>
    <div class="input-group mb-3 mt-3">
            <span class="input-group-text" id="basic-addon1">Tanggal pinjam</span>
            <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control" value="<?= $sekarang; ?>" placeholder="id buku" aria-label="tgl_peminjaman" aria-describedby="basic-addon1" onchange="setReturnDate()" required>
      </div>
    <div class="input-group mb-3 mt-3">
            <span class="input-group-text" id="basic-addon1">Tanggal akhir peminjaman</span>
            <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control" placeholder="tgl_pengembalian" aria-label="tgl_pengembalian" aria-describedby="basic-addon1" readonly>
      </div>
      
    <a class="btn btn-danger" href="dashboard.php"> Batal</a>
    <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
    </form>
    </div>
    </div>

      </div> 
      <!-- /.card -->
  </div>
  </div>
  </div>

    <!--JAVASCRIPT -->
    <script src="../style/js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>