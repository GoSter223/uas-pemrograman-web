<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
$edit = false;
if (isset($_POST['logout'])) {
  unset($_SESSION);
  session_destroy();
  header("location:home.php");
}

if (isset($_POST['intrupsi'])) {
  $intrupsi = true;
}

if (isset($_POST['batal'])) {
  $intrupsi = false;
  $edit = false;
}

if (isset($_POST['back'])) {
  header("location:home.php");
}

if (isset($_SESSION['login'])) {
  $data = mysqli_query($koneksi, "select * from akun");
  while ($d = mysqli_fetch_array($data)) {
    if ($_SESSION['login'] == $d['username']) {
      //menciptakan session
      $email = $d['email'];
      $nama = $d['nama'];
    }
  }
}

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $username = $_SESSION['login'];
  mysqli_query($koneksi, "UPDATE akun SET nama='$nama', email='$email' WHERE username='$username'");
  $edit = true;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="profil.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar bg-dark mb-4">
    <div class="container-fluid">
      <form class="d-flex" method="post">
        <button name="back" class="navbar-brand border-0 bg-dark text-light"><i class="bi bi-arrow-left"></i></button>
      </form>
      <form class="d-flex" method="post">
        <button class="profil text-center rounded bg-dark text-light ms-3 border-0" type="submit" name="intrupsi"><i class="bi bi-box-arrow-right"></i></button>
      </form>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!-- body -->
  <div class="container">
    <div class="row">
      <div class="col-3 offset-1">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action active">Profil</a>
          <a href="password.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Keamanan</a>
        </div>
      </div>
      <div class="col-6 rounded bg-dark text-light">
        <div class="row">
          <div class="col-12 pt-3 pb-3">
            <div class="">
              <img src="profile1.png" class="foto rounded-circle mx-auto d-block" alt="...">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8 offset-2 mb-3">
            <form method="post">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nama</label>
                <input name="nama" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $nama; ?>" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email; ?>" required>
              </div>
              <button name="simpan" type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if ($intrupsi === true) { ?>
    <div class="container">
      <div class="p" style="background-color: black; left:0; position: absolute; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
      <div class="row">
        <div class="py-4 col-3 text-center position-absolute top-50 start-50 translate-middle bg-black rounded text-white" style="z-index:99;">
          <p>Apakah anda yakin ingin keluar?</p>
          <form method="post">
            <button name="batal" class="btn btn-primary me-5">Tidak</button>
            <button name="logout" class="btn btn-danger ms-3">Ya</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <?php if ($edit === true) { ?>
    <div class="container">
      <div class="p" style="background-color: black; left:0; position: absolute; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
      <div class="row">
        <div class="py-4 col-3 text-center position-absolute top-50 start-50 translate-middle bg-black rounded text-white" style="z-index:99;">
          <p>Data anda berhasil diubah.</p>
          <form method="post">
            <button name="batal" class="btn btn-primary">Ok</button>

          </form>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <!-- akhir body -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>