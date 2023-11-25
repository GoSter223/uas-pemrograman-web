<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
if (isset($_POST['back'])) {
  header("location:home.php");
}

if (isset($_POST['profil'])) {
  header("location:profil.php");
}

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
}

if (isset($_POST['simpan'])) {
  //menangkap data yang dikiri dari form
  $folder = './icon_apl/';
  $nama_icon = $_FILES['icon']['name'];
  $sumber_icon = $_FILES['icon']['tmp_name'];
  $nama = $_POST['nama'];
  $kategori = $_POST['action'] . $_POST['adventure'] . $_POST['rpg'] . ' |';
  $deskripsi = $_POST['deskripsi'];
  move_uploaded_file($sumber_icon, $folder . $nama_icon);
  //menginput data ke database
  mysqli_query($koneksi, "insert into aplikasi values('$nama_icon','$nama','$kategori','$deskripsi')");

  //mengalihkan halaman kembali ke index.php
  header("location:tambah.html");
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
                <button name="back" class="navbar-brand border-0 bg-dark text-light"><i class="bi bi-arrow-left"></i></button>
              </form>
              <form class="d-flex justify-content-end formprofil" method="post">
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
                  <a href="admin.php" class="bg-dark text-light border-dark list-group-item list-group-item-action" aria-current="true">Daftar aplikasi</a>
                  <a href="anggota.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Daftar anggota</a>
                  <a href="#" class="list-group-item list-group-item-action active">Tambah aplikasi</a>
                </div>
              </div>
              <div class="col-7 rounded bg-dark text-light">
                <form method="post" enctype="multipart/form-data">
                  <div class="row justify-content-center pt-3 pb-3">
                    <label for="icon" class="iconapp text-center bg-secondary">
                      <input name="icon" type="file" id="icon" style="display: none;" required>
                      <i class="bi bi-image"></i>
                    </label>

                  </div>
                  <div class="row">
                    <div class="col-8 offset-2 mb-3">

                      <div class="mb-3">
                        <label for="nama" class="form-label">Nama aplikasi</label>
                        <input name="nama" type="text" class="form-control" id="nama" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kategori</label><br>
                        <div class="form-check form-check-inline">
                          <input name="action" class="form-check-input" type="checkbox" id="action" value="| Action">
                          <label class="form-check-label" for="action">Action</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="adventure" class="form-check-input" type="checkbox" id="adventure" value="| Adventure">
                          <label class="form-check-label" for="adventure">Adventure</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input name="rpg" class="form-check-input" type="checkbox" id="rpg" value="| RPG">
                          <label class="form-check-label" for="rpg">RPG</label>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required></textarea>
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
              <div class="p" style="background-color: black; left:0; position: fixed; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
              <div class="row">
                <div class="py-4 col-3 text-center position-fixed top-50 start-50 translate-middle bg-black rounded text-white" style="z-index:99;">
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