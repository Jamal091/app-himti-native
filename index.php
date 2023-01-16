<?php
    /**
    * Mengaktifkan session
    */
    session_start();
    /**
    * Memuat file koneksi database
    */
    require_once "koneksi.php";
    /**
    * Inisialisasi variabel p untuk menentukan menu dan halaman yang aktif
    */
        $p = isset($_GET["p"]) ? $_GET["p"] : "home";
        $is_active_home = ($p == "home") ? "active" : "";
        $is_active_tambah_anggota = ($p == "tambah-anggota") ? "active" : "";
        $is_active_anggota = ($p == "anggota") ? "active" : "";
        $is_active_login = ($p == "login") ? "active" : "";
    /**
    * Proses logout
    */
    if ($p == "logout")
        {
        unset($_SESSION["NamaPengguna"]);
        header("Location: ?p=home");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>APP HIMTI NATIVE</title>
    <!-- Memuat file CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HIMTI</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
<?php
/**
* Memuat menu untuk pengguna admin
*/
    if (isset($_SESSION["NamaPengguna"]))
    {
?>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_home; ?>" href="?p=home">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_tambah_anggota; ?>" href="?p=tambah-anggota">Tambah Anggota</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_anggota; ?>" href="?p=anggota">Lihat Anggota</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_logout ?>" href="?p=logout">Logout</a>
    </li>

<?php
    }
/**
* Memuat menu untuk pengguna umum
*/
    else
    {
?>

    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_home; ?>" href="?p=home">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_anggota; ?>" href="?p=anggota">Lihat Anggota</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_active_login; ?>" href="?p=login">Login</a>
    </li>

<?php
    }
?>
    </ul>
    </div>
    </div>
    </nav>
<?php
/**
* Memuat halaman isi sesuai dengan parameter p
*/
    switch ($p)
    {
        case "login":
            require_once "login.php";
        break;
        case "anggota":
            require_once "anggota.php";
        break;
        case "tambah-anggota":
            require_once "tambah-anggota.php";
        break;
        case "edit-anggota":
            require_once "edit-anggota.php";
        break;
        default:
            require_once "home.php";
        break;
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>