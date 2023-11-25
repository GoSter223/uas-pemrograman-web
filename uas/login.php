<?php
include 'koneksi.php';
session_start();
$intrupsi = false;
$berhasil = false;

if (isset($_POST['simpan'])) {
    // menangkap data yang dikirim dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($data) > 0) {
        $dat = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username'");
        $da = mysqli_query($koneksi, "SELECT * FROM akun WHERE email='$email'");
        if (mysqli_num_rows($dat) > 0) {
            $ingagal = "Username";
        } else if (mysqli_num_rows($da) > 0) {
            $ingagal = "Email";
        }
        $intrupsi = true;
    } else {
        // menginput data ke database
        mysqli_query($koneksi, "INSERT INTO akun (nama, email, username, password) VALUES ('$nama','$email','$username','$password')");
        header("location:berhasil.html");
        exit();
    }
}

if (isset($_POST['login'])) {
    // menangkap data yang dikirim dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($data) > 0) {
        // menciptakan session
        $d = mysqli_fetch_array($data);
        $_SESSION['login'] = $d['username'];
        header("location:home.php");
        exit();
    } else {
        $error_message = "Username atau password yang anda masukkan salah.";
    }
}

if (isset($_POST['back'])) {
    header("location:home.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <!-- panel login -->
    <div class="container">
        <div class="row position-relative text-light">
            <div class="col-3 offset-3 shadow-lg rounded-start purple">
                <form method="post">
                    <button name="back" class="navbar-brand border-0 mb-3 mt-2  purple1"><i class="bi bi-arrow-left"></i></button>
                </form>
                <form class="pt-4" method="post" action="">
                    <div class="mb-3">
                        <label for="loginuser" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="loginuser" aria-describedby="emailHelp" autofocus required>
                    </div>
                    <div class="mb-1">
                        <label for="userpass" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="userpass" required>
                    </div>
                    <?php if (isset($error_message)) : ?>
                        <p class="text-danger ps"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <button name="login" type="submit" class="btn btn-primary mt-2">Login</button>
                </form>
            </div>
            <div class="col-3 shadow-lg rounded-end purple">
                <form method="post" action="login.php">
                    <div class="mb-2">
                        <label for="nama" class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" id="nama" aria-describedby="emailHelp" autofocus required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Alamat E-mail</label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" name="simpan">Submit</button>
                </form>
            </div>
            <div id="geser" class="col-3 position-absolute bg-dark tutup offset-6 rounded text-center">
                <img src="logo.png" alt="" style="width: 140px; height: 120px; margin-top: 20px;">
                <div>
                    <h2>Welcome!</h5>
                        <h5>Login to explore the world of imagination.</h5>
                </div>
                <form method="post" class="rowback backre">
                    <button name="back" class="navbar-brand border-0 mb-3 mt-2"><i class="bi bi-arrow-left"></i></button>
                </form>
                <div class="div text-center">
                    <button id="modeSwitch" class="btn btn-primary goregist">Sign In</button>
                </div>
            </div>
        </div>

        <?php if ($intrupsi === true) : ?>
            <div class="container">
                <div class="p" style="background-color: black; left:0; position: absolute; top: 0px; bottom: 0; right: 0; z-index: 88; opacity: .5;"></div>
                <div class="row">
                    <div class="py-4 gagal col-3 text-center position-absolute top-50 start-50 translate-middle bg-black rounded" style="z-index:99;">
                        <h4 class="">GAGAL</h1>
                            <p><?php echo $ingagal ?> sudah digunakan.</p>
                            <a href="login.php" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_SESSION['register_success'])) { // Ubah pengecekan ini
                $intrupsi = false;
                unset($_SESSION['register_success']); // Hapus session register_success
            }
            ?>
        <?php endif; ?>
    </div>
    <!-- akhir panel login -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="login.js"></script>
</body>

</html>