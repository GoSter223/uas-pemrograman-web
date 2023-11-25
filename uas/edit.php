<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
$nama = "";
$kategori = "";
$deskripsi = "";
$icon = "";
if (isset($_POST['back'])) {
  header("location:home.php");
}

if (isset($_POST['kembali'])) {
  header("location:admin.php");
}

if (isset($_POST['profil'])) {
  header("location:profil.php");
}

if (isset($_POST['logout'])) {
  unset($_SESSION);
  session_destroy();
  header("location:home.php");
}

if (isset($_SESSION['login'])) {
  $data = mysqli_query($koneksi, "select * from aplikasi");
  while ($d = mysqli_fetch_array($data)) {
    if (isset($_POST['nama']) && $_POST['nama'] == $d['nama']) {
      //menciptakan session
      $icon = $d['icon'];
      $nama = $d['nama'];
      $kategori = $d['kategori'];
      $deskripsi = $d['deskripsi'];
    }
  }
}

if (isset($_POST['simpan'])) {
  $icon = $_POST['icon'];
  $nama = $_POST['nama'];
  $kategori = '';
  if (isset($_POST['action'])) {
    $kategori .= '| Action ';
  }
  if (isset($_POST['adventure'])) {
    $kategori .= '| Adventure ';
  }
  if (isset($_POST['rpg'])) {
    $kategori .= '| RPG ';
  }
  $kategori .= '|';
  $deskripsi = $_POST['deskripsi'];
  mysqli_query($koneksi, "UPDATE aplikasi SET icon='$icon', kategori='$kategori', deskripsi='$deskripsi' WHERE nama='$nama'");

  //mengalihkan halaman kembali ke admin.php
  header("location:editapl.html");
}

if (isset($_SESSION['login'])) {
  $data = mysqli_query($koneksi, "select * from akun");
  while ($d = mysqli_fetch_array($data)) {
    if ($_SESSION['login'] == $d['username']) {
      if ('alif' == $d['username']) {
?>
        <!doctype html>
        <html lang="en">

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>admin</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
          <link rel="stylesheet" href="profil.css">
          <link rel="stylesheet" href="home.css">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        </head>

        <body>
          <!-- navbar -->
          <nav class="navbar bg-dark mb-4">
            <div class="container-fluid">
              <form class="d-flex" method="post">
                <button name="back" class="navbar-brand bg-dark text-light border-0"><i class="bi bi-arrow-left"></i></button>
              </form>
              <form class="d-flex justify-content-end formprofil" method="post" action="admin.php">
                <?php
                echo '<button class="profil text-center rounded bg-dark text-light ms-3" type="submit" name="intrupsi"><i class="bi bi-box-arrow-right"></i></button>';
                ?>
              </form>
            </div>
          </nav>
          <!-- akhir navbar -->

          <!-- body -->
          <div class="container-fluid">
            <div class="row pe-2">
              <div class="col-3">
                <div class="list-group">
                  <a href="admin.php" class="list-group-item list-group-item-action active" aria-current="true">Daftar aplikasi</a>
                  <a href="anggota.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Daftar anggota</a>
                  <a href="tambah.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Tambah aplikasi</a>
                </div>
              </div>
              <div class="col-7 rounded bg-dark text-light">
                <!-- navbar -->
                <nav class="navbar bg-dark mb-4">
                  <div class="container-fluid">
                    <form class="d-flex" method="post">
                      <button name="kembali" class="navbar-brand bg-dark text-light border-0"><i class="bi bi-arrow-left"></i></button>
                    </form>
                  </div>
                </nav>
                <!-- akhir navbar -->
                <form method="post" enctype="multipart/form-data">
                  <div class="row justify-content-center pt-3 pb-3">
                    <label for="icon" class="iconapp text-center">
                      <input name="icon" type="text" id="icon" style="display: none;" value="<?php echo $icon ?>">
                      <img src="icon_apl/<?php echo $icon; ?>" class="card-img-top icon-apl2" alt="<?php echo $icon; ?>">
                    </label>

                  </div>
                  <div class="row">
                    <div class="col-8 offset-2 mb-3">

                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama aplikasi</label>
                        <input name="nama" type="text" class="form-control" id="nama" value="<?php echo $nama ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kategori</label><br>
                        <p><?php echo $kategori ?></p>
                        <div class="form-check form-check-inline">
                          <input name="action" class="form-check-input" type="checkbox" id="action" value="1" <?php if (strpos($kategori, 'Action') !== false) echo 'checked'; ?>>
                          <label class="form-check-label" for="action">Action</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="adventure" class="form-check-input" type="checkbox" id="adventure" value="1" <?php if (strpos($kategori, 'Adventure') !== false) echo 'checked'; ?>>
                          <label class="form-check-label" for="adventure">Adventure</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="rpg" class="form-check-input" type="checkbox" id="rpg" value="1" <?php if (strpos($kategori, 'RPG') !== false) echo 'checked'; ?>>
                          <label class="form-check-label" for="rpg">RPG</label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"><?php echo $deskripsi ?></textarea>
                      </div>
                      <button name="simpan" type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
          </div>
          </div>
          <!-- akhir body -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
      } else {
        header("location:home.php");
      }
    }
  }
} else {
  header("location:home.php");
}
?>