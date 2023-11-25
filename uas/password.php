<?php
include 'koneksi.php';
session_start();
$edit = false;
$intrupsi = false;
if (isset($_POST['logout'])) {
  unset($_SESSION);
  session_destroy();
  header("location:home.php");
}

if (isset($_POST['back'])) {
  header("location:home.php");
}

if (isset($_POST['batal'])) {
  $edit = false;
}

if (isset($_POST['intrupsi'])) {
  $intrupsi = true;
}

if (isset($_SESSION['login'])) {
  $data = mysqli_query($koneksi, "select * from akun");
  while ($d = mysqli_fetch_array($data)) {
    if ($_SESSION['login'] == $d['username']) {
      //menciptakan session
      $password = $d['password'];
      $username = $d['username'];
    }
  }
}

if (isset($_POST['simpan'])) {
  if (($_POST['password']) === ($_POST['konfirmasi'])) {
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];
    mysqli_query($koneksi, "UPDATE akun SET password='$password' WHERE username='$username'");
    $edit = true;
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="profil.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar bg-dark mb-4">
    <div class="container-fluid">
      <form class="d-flex" method="post">
        <button name="back" class="navbar-brand bg-dark text-light border-0"><i class="bi bi-arrow-left"></i></button>
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
          <a href="profil.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Profil</a>
          <a href="#" class="list-group-item list-group-item-action active">Keamanan</a>
        </div>
      </div>
      <div class="col-6 rounded bg-dark text-light mb-4">
        <div class="row justify-content-center pt-3 pb-3">
          <div class="text-center password rounded-circle bg-secondary">
            <i class="bi bi-shield-lock-fill"></i>
          </div>
        </div>
        <div class="row">
          <div class="col-8 offset-2 mb-3">
            <form method="post">
              <fieldset disabled>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Username</label>
                  <input name="username" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $username; ?>">
                </div>
                <div class="mb-3">
                  <label for="disabledTextInput" class="form-label">Password</label>
                  <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $password; ?>">
                </div>
              </fieldset>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                <input name="konfirmasi" type="password" class="form-control" id="exampleInputPassword1" required>
                <?php
                if (isset($_POST['simpan'])) {
                  if (($_POST['password']) !== ($_POST['konfirmasi'])) {
                ?>
                    <div id="emailHelp" class="form-text text-danger">Password yang anda tulis ulang salah.</div>
                  <?php
                  }
                } else {
                  ?>
                  <div id="emailHelp" class="form-text">Tulis ulang password baru yang anda buat.</div>
                <?php
                }
                ?>
              </div>
              <button name="simpan" type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if ($edit === true) { ?>
    <div class="container">
      <div class="p" style="background-color: black; left:0; position: absolute; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
      <div class="row">
        <div class="py-4 col-3 text-center position-absolute top-50 start-50 translate-middle bg-black rounded text-white" style="z-index:99;">
          <p>Password anda berhasil diubah.</p>
          <form method="post">
            <button name="batal" class="btn btn-primary">Ok</button>

          </form>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
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
  <!-- akhir body -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>