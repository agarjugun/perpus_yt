<?php 
require "loginSystem/connect.php";
if(isset($_POST["signUp"]) ) {
  
  if(signUp($_POST) > 0) {
    echo "<script>
    alert('Sign Up berhasil!')
    </script>";
  }else {
    echo "<script>
    alert('Sign Up gagal!')
    </script>";
  }
  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
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
.card-4 {
  background: transparent;
  -webkit-border-radius: 100px;
  -moz-border-radius: 10px;
  border-radius: 100px;
  backdrop-filter: blur(55px);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.title {
  font-size: 30px;
  color: #000000;
  font-weight: 400;
  margin-bottom: 40px;
  font-weight: bold; /* atau bisa juga menggunakan nilai numerik seperti 700 */
  text-align: center; /* Teks menjadi di tengah horizontal */
}
.label {
  font-size: 16px;
  color: #000000;
  text-transform: capitalize;
  display: block;
  margin-bottom: 5px;
  font-weight: bold; /* atau bisa juga menggunakan nilai numerik seperti 700 */
}
.input--style-4 {
  line-height: 40px;
}
.rs-select2 .select2-container .select2-selection--single {
  outline: none;
  border: none;
  height: 40px;
  background: transparent;
}

.rs-select2 .select2-container .select2-selection--single .select2-selection__rendered {
  line-height: 40px;
  padding-left: 0;
  color: #555;
  font-size: 16px;
  font-family: inherit;
  padding-left: 22px;
  padding-right: 50px;
}

.rs-select2 .select2-container .select2-selection--single .select2-selection__arrow {
  height: 40px;
  right: 20px;
  display: flex;
}
.btn {
  line-height: 40px;
  padding: 0 40px;
}
</style>
<body>
    <div class="page-wrapper font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Daftar Akun Siswa</h2>
                    <form method="POST">
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">NISN</label>
                <input class="input--style-4" type="number" name="nisn">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Nama</label>
                <input class="input--style-4" type="text" name="nama">
            </div>
        </div>
    </div>
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <label class="label">Password</label>
                <input class="input--style-4" type="password" name="password">
            </div>
        </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Alamat</label>
                <input class="input--style-4" type="text" name="alamat">
            </div>
        </div>
    </div>
    <div class="row row-space">
    <div class="col-2">
            <div class="input-group">
                <label class="label">Kelas</label>
                <div class="rs-select2 js-select-simple select--no-search">
                    <select name="kelas">
                        <option disabled="disabled" selected="selected">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                    <div class="select-dropdown"></div>
                </div>
            </div>
            </div>
        <div class="col-2">
            <div class="input-group">
                <label class="label">Jurusan</label>
                <div class="rs-select2 js-select-simple select--no-search">
                    <select name="jurusan">
                        <option disabled="disabled" selected="selected">Pilih Jurusan</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Otomatisasi Tata Kelola Perkantoran">Otomatisasi Tata Kelola Perkantoran</option>
                        <option value="BDP">BDP</option>
                        <option value="Multi Media">Multi Media</option>
                        <option value="AKL">AKL</option>
                    </select>
                    <div class="select-dropdown"></div>
                </div>
            </div>
            </div>  
    <div class="p-t-15">
        <button class="btn btn--radius-2 btn--blue" name="signUp" type="submit">Daftar</button>
        <div style="margin-top: 10px;">   
    <p style="color:white;">Sudah punya akun? <b><a href="login.php" class="btn-link" style="color: white; text-decoration: none;">Login</a></b></p>
</div>

    </div>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->