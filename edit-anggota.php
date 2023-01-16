<?php
/**
* Membatasi akses hanya untuk pengguna admin
*/
if (!isset($_SESSION["NamaPengguna"]))
    {
        header("Location: ?p=home");
    }
/**
* Inisialisasi variabel form edit anggota
*/
$id = isset($_GET["id"]) ? $_GET["id"] : "";
$hdnID = isset($_POST["hdnID"]) ? $_POST["hdnID"] : "";
$txtKodeAnggota = isset($_POST["txtKodeAnggota"]) ? $_POST["txtKodeAnggota"] : "";
$txtNamaAnggota = isset($_POST["txtNamaAnggota"]) ? $_POST["txtNamaAnggota"] : "";
$cmdSimpan = isset($_POST["cmdSimpan"]) ? $_POST["cmdSimpan"] : "";
$notifikasi = "";
/**
* Mengalihkan halaman ke tabel anggota apabila id data kosong
*/
if ($id == "")
    {
        header("Location: ?p=anggota");
    }
/**
* Proses untuk memuat data yang akan diedit
*/
if ($cmdSimpan == "Simpan" && $hdnID != "" && $txtKodeAnggota != "" && $txtNamaAnggota != "")
    {
        $sql_update = "UPDATE anggota SET kode_anggota='".$txtKodeAnggota."', nama_anggota='".$txtNamaAnggota."' WHERE id=".$hdnID;

if ($koneksi_db->query($sql_update))
    {
        $notifikasi = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Sukses memperbaharui sebuah data anggota. Klik tombol Batal untuk kembali ke halaman daftar anggota.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
else
    {
        $notifikasi = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Terjadi kesalahan pada sistem. Data tidak dapat diperbaharui.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
    }
    $sql_edit = "SELECT * FROM anggota WHERE id=".$id;
    $kueri_edit = $koneksi_db->query($sql_edit);
    $data_edit = $kueri_edit->fetch_array();
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
        <h3>Edit Data Anggota</h3>
        <form action="?p=edit-anggota&id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="hdnID" value="<?php echo $data_edit['id']; ?>">

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kode Anggota</label>

        <div class="col-sm-9">
            <input type="text" class="form-control" name="txtKodeAnggota" value="<?php echo $data_edit['kode_anggota']; ?>" required>

        </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Anggota</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="txtNamaAnggota" value="<?php echo $data_edit['nama_anggota']; ?>" required>

        </div>
        </div>
            <button type="submit" name="cmdSimpan" value="Simpan" class="btn btn-success">Simpan</button>
            <a href="?p=anggota" class="btn btn-warning">Batal</a>
        </form>
        </div>
    </div>
</div>