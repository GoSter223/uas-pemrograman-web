<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
$hapus = false;
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

if (isset($_POST['hapus'])) {
  $namaapl = $_POST['nama'];
  $hapus = true;
}

if (isset($_POST['batal'])) {
  $intrupsi = false;
}

if (isset($_POST['clear'])) {
  $nama = $_POST['nama'];
  mysqli_query($koneksi, "DELETE FROM aplikasi WHERE nama='$nama'") or die(mysqli_error());
  header("location:admin.php");
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
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
          <link rel="stylesheet" href="home.css">
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
                  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Daftar aplikasi</a>
                  <a href="anggota.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Daftar anggota</a>
                  <a href="tambah.php" class="bg-dark text-light border-dark list-group-item list-group-item-action">Tambah aplikasi</a>
                </div>
              </div>
              <div class="col-9 rounded bg-dark text-light">
                <!-- nav daf -->
                <nav class="navbar bg-dark mb-3">
                  <div class="container-fluid">
                    <form class="d-flex" role="search">
                      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                      <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                  </div>
                </nav>
                <!-- akhir nav daf -->
                <!-- daf apl -->
                <div class="container">
                  <div class="row">
                    <?php
                    $data = mysqli_query($koneksi, "select * from aplikasi");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                      <div class="col-2 mb-3">
                        <div class="card bg-dark text-light" style="box-shadow: 1px 1px 5px grey;">
                          <img src="icon_apl/<?php echo $d['icon']; ?>" class="card-img-top icon-apl" alt="<?php echo $d['icon']; ?>">
                          <div class="card-body">
                            <h5 class="card-title ellipsis"><?php echo $d['nama']; ?></h5>
                            <p class="card-text ellipsis" style="font-size:12px;"><?php echo $d['kategori']; ?></p>
                            <div class="div d-flex">
                              <form action="edit.php" method="post" class="me-2">
                                <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                                <button class="btn btn-primary" type="submit" name="edit">Edit</button>
                              </form>
                              <form action="" method="post">
                                <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                                <button class="btn btn-danger" type="submit" name="hapus">Hapus</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>
                <!-- akhir daf -->
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
          <?php if ($hapus === true) { ?>
            <div class="container">
              <div class="p" style="background-color: black; left:0; position: fixed; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
              <div class="row">
                <div class="py-4 col-3 text-center position-fixed top-50 start-50 translate-middle bg-black rounded text-white" style="z-index:99;">
                  <p>Apakah anda yakin ingin menghapus aplikasi <?php echo $namaapl ?>?</p>
                  <form method="post">
                    <input type="hidden" name="nama" value="<?php echo $namaapl ?>">
                    <button name="batal" class="btn btn-primary me-5">Tidak</button>
                    <button name="clear" class="btn btn-danger ms-3">Ya</button>
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