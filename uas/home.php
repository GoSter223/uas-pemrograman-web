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

if (isset($_POST['intrupsi'])) {
  $intrupsi = true;
}

if (isset($_POST['batal'])) {
  $intrupsi = false;
}

if (isset($_POST['admin'])) {
  header("location:admin.php");
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
  <nav class="navbar fixed-top mb-4 bg-dark text-light">
    <div class="container-fluid">
      <a class="icon mt-0 ms-3"><img src="logo.png" alt="" style="width: 50px; height: 40px;"></a>
      <form class="d-flex col-3 searchbar" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      </form>
      <form class="d-flex justify-content-end formprofil" method="post">
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
          echo '<button class="profil text-center rounded bg-dark text-secondary ms-3" type="submit" name="intrupsi"><i class="bi bi-box-arrow-right"></i></button>';
        } else {
          echo '<button class="btn btn-success" type="submit" name="masuk">Login</button>';
        }
        ?>
      </form>
    </div>
  </nav>
  <!-- akhir navbar -->

  <!-- body -->
  <div class="container" style="margin-top: 80px;">
    <div class="row">
      <div class="col-10 offset-1">
        <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel" style=" height: 500px;">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner rounded-4">
            <div class="carousel-item active">
              <img src="Death-Stranding.jpg" class="d-block w-100" alt="..." style="height: 500px;">
              <div class="carousel-caption d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="ghost-hunt.jpg" class="d-block w-100" alt="..." style="height: 500px;">
              <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="images.jpg" class="d-block w-100" alt="..." style="height: 500px;">
              <div class="carousel-caption d-none d-md-block">
                <h5></h5>
                <p></p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      $data = mysqli_query($koneksi, "select * from aplikasi");
      while ($d = mysqli_fetch_array($data)) {
      ?>
        <div class="col-2 mb-4">
          <div class="card bg-dark text-light">
            <img src="icon_apl/<?php echo $d['icon']; ?>" class="card-img-top icon-apl2" alt="<?php echo $d['icon']; ?>">
            <div class="card-body">
              <h5 class="card-title ellipsis"><?php echo $d['nama']; ?></h5>
              <p class="card-text ellipsis"><?php echo $d['kategori']; ?></p>
              <div class="div d-flex">
                <form action="app.php" method="post" class="me-2">
                  <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                  <button class="btn btn-primary" type="submit" name="detail">Detail</button>
                </form>
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                    <button class="btn btn-success" type="submit" name="install">Install</button>
                  </form>
                <?php
                } else {
                ?>
                  <form action="" method="post">
                    <input type="hidden" name="nama" value="<?php echo $d['nama']; ?>">
                    <button class="btn btn-success" type="submit" name="masuk">Install</button>
                  </form>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>

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
  <script>
    const myCarouselElement = document.querySelector('#carouselExampleAutoplaying')

    const carousel = new bootstrap.Carousel(myCarouselElement, {
      interval: 3000,
      touch: false
    })
  </script>
</body>

</html>
<?php
?>