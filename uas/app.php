<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
if (isset($_POST['masuk'])) {
  header("location:login.php");
}

if (isset($_POST['profil'])) {
  header("location:profil.php");
}

if (isset($_POST['logout'])) {
  unset($_SESSION);
  session_destroy();
  header("location:home.php");
}

if (isset($_POST['admin'])) {
  header("location:admin.php");
}

if (isset($_POST['back'])) {
  header("location:home.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar bg-dark mb-4">
    <div class="container-fluid">
      <form class="d-flex" method="post">
        <button name="back" class="navbar-brand bg-dark text-light border-0"><i class="bi bi-arrow-left"></i></button>
        <a class="icon mt-0 ms-3"><img src="logo.png" alt="" style="width: 50px; height: 40px;"></a>
      </form>
      <form class="d-flex col-3 searchbar" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>
      <form class="d-flex justify-content-end formprofil" method="post" action="home.php">
        <?php
        if (isset($_SESSION['login'])) {
          $data = mysqli_query($koneksi, "select * from akun");
          while ($d = mysqli_fetch_array($data)) {
            if ($_SESSION['login'] == $d['username']) {
              if ('alif' == $d['username']) {
                echo '<button class="btn btn-success me-3" type="submit" name="admin">Kelola Admin</button>';
              } else {
                echo '<h6 class="nama me-3">' . $_SESSION['login'] . '</h6>';
              }
            }
          }
        }
        ?>
        <?php
        if (isset($_SESSION['login'])) {
          echo '<button class="profil text-center rounded-circle bg-secondary text-white" type="submit" name="profil"><i class="bi bi-person-fill"></i></button>';
          echo '<button class="profil text-center rounded  bg-dark text-light ms-3" type="submit" name="intrupsi"><i class="bi bi-box-arrow-right"></i></button>';
        } else {
          echo '<button class="btn btn-success" type="submit" name="masuk">Login</button>';
        }
        ?>
      </form>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!-- body -->
  <?php
  if (isset($_POST['detail'])) {
    $nama = $_POST['nama'];
    $data = mysqli_query($koneksi, "select * from aplikasi");
    while ($d = mysqli_fetch_array($data)) {
      if ($nama === $d['nama']) {
  ?>
        <div class="container">
          <div class="row">
            <div class="col-4 d-flex justify-content-center">
              <img style="width: 300px; height: 300px;" src="icon_apl/<?php echo $d['icon']; ?>" class="img-thumbnail bg-dark border-secondary" alt="<?php echo $d['icon']; ?>">
            </div>
            <div class="col-8 border-bottom border-secondary-subtle pb-2 text-light">
              <div class="row">
                <div class="col-12">
                  <h1><?php echo $d['nama'] ?></h1>
                  <p><?php echo $d['kategori'] ?></p>
                  <p><?php echo $d['deskripsi'] ?></p>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="col-12 d-flex justify-content-center pt-2">
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                    <button class="btn btn-success install" type="submit" name="install">Install</button>
                  </form>
                <?php
                } else {
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                    <button class="btn btn-success install" type="submit" name="masuk">Install</button>
                  </form>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>

  <?php
      }
    }
  }
  ?>
  <!-- akhir body -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>
<?php
?>