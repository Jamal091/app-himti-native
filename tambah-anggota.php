<?php
    /**
    * Membatasi akses hanya untuk pengguna admin
    */
    if (!isset($_SESSION["NamaPengguna"]))
        {
        header("Location: ?p=home");
        }
/**
* Inisialisasi variabel form tambah anggota
*/
$txtKodeAnggota = isset($_POST["txtKodeAnggota"]) ? $_POST["txtKodeAnggota"] : "";
$txtNamaAnggota = isset($_POST["txtNamaAnggota"]) ? $_POST["txtNamaAnggota"] : "";
$cmdSimpan = isset($_POST["cmdSimpan"]) ? $_POST["cmdSimpan"] : "";
$notifikasi = "";
/**
* Proses tambah data dilakukan jika pengguna mengklik tombol simpan dan semua data diisi
*/
if ($cmdSimpan == "Simpan" && $txtKodeAnggota != "" &&
$txtNamaAnggota != "")
{
/**
* Menyimpan data ke database
*/
$sql_tambah_anggota = "INSERT INTO anggota (kode_anggota, nama_anggota) VALUES('". $txtKodeAnggota ."', '". $txtNamaAnggota ."')";
$kueri_tambah_anggota = $koneksi_db->query($sql_tambah_anggota);
if ($kueri_tambah_anggota)

    {
        $notifikasi = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data anggota atas nama ". $txtNamaAnggota ." telah disimpan.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
else
    {
        $notifikasi = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Terjadi kesalahan pada sistem. Data tidak dapat disimpan.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
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
<h3>Tambah Data Anggota</h3>
    <form action="?p=tambah-anggota" method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Kode Anggota</label>

        <div class="col-sm-9">
            <input type="text" class="form-control" name="txtKodeAnggota" value="<?php echo $txtKodeAnggota; ?>" required>

        </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama Anggota</label>

        <div class="col-sm-9">
            <input type="text" class="form-control" name="txtNamaAnggota" value="<?php echo $txtNamaAnggota; ?>" required>

        </div>
        </div>
    <button type="submit" name="cmdSimpan" value="Simpan" class="btn btn-success">Simpan</button>
            <a href="?p=anggota" class="btn btn-warning">Batal</a>
    </form>
        </div>
    </div>
</div>