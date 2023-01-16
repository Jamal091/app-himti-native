<?php
/**
* Inisialisasi variabel form login
*/
$txtNamaPengguna = isset($_POST["txtNamaPengguna"]) ?
$_POST["txtNamaPengguna"] : "";
$txtKataSandi = isset($_POST["txtKataSandi"]) ?
$_POST["txtKataSandi"] : "";
$cmdLogin = isset($_POST["cmdLogin"]) ? $_POST["cmdLogin"] : "";
$notifikasi = "";
/**
* Verifikasi login dilakukan apabila pengguna telah mengisi data nama pengguna dan kata sandi serta meng-klik tombol login
*/
if ($cmdLogin == "Login" && $txtNamaPengguna != "" && $txtKataSandi != "")
{
    /**
* Memeriksa data pengguna pada database
*/
$sql_select_pengguna = "SELECT * FROM pengguna WHERE nama_pengguna='". $txtNamaPengguna ."' AND kata_sandi='".MD5($txtKataSandi)."'";
$kueri_select_pengguna = $koneksi_db->query($sql_select_pengguna);
if ($kueri_select_pengguna)
{
$jumlah_pengguna = $kueri_select_pengguna->num_rows;
/**
* Jika terdapat 1 data yang sesuai, maka login berhasil
* Jika tidak, maka login gagal
*/
if ($jumlah_pengguna == 1)
{
/**
* Merekam sesi pengguna dan mengalihkan halaman ke home

*/
$_SESSION["NamaPengguna"] = $txtNamaPengguna;
header("Location: ?p=home");
}
else
{
/**
* Membuat notifikasi
*/
$notifikasi = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Nama Pengguna dan atau Kata Sandi Anda tidak sesuai.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

}
}
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
    <p>&nbsp;</p>
<?php
/**
* Menampilkan notifikasi jika tersedia
*/
if ($notifikasi != "")
{
echo $notifikasi;
}
?>
    <form action="?p=login" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Pengguna</label>

        <div class="col-sm-9">
            <input type="text" class="form-control" name="txtNamaPengguna" value="<?php echo $txtNamaPengguna; ?>" required>

        </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kata Sandi</label>

        <div class="col-sm-9">
            <input type="password" class="form-control" name="txtKataSandi" required>

        </div>
        </div>
    <button type="submit" name="cmdLogin" value="Login" class="btn btn-success">Login</button>
    </form>
        </div>
    </div>
</div>