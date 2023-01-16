<?php
/**
* Inisialisasi variabel form cari dan hapus anggota
*/
$q = isset($_POST["q"]) ? $_POST["q"] : "";
$hdnID = isset($_POST["hdnID"]) ? $_POST["hdnID"] : "";
$cmdHapus = isset($_POST["cmdHapus"]) ? $_POST["cmdHapus"] : "";
$notifikasi = "";
/**
* Menghapus data anggota
*/
if ($cmdHapus == "Hapus" && $hdnID != "")
{
        $sql_delete_anggota = "DELETE FROM anggota WHERE id=".$hdnID;
if ($koneksi_db->query($sql_delete_anggota))
    {
        $notifikasi = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Sukses menghapus sebuah data anggota.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
else
    {
        $notifikasi = "<div class='alert alert-dangeralert-dismissible fade show' role='alert'>Terjadi kesalahan pada sistem. Data tidak dapat dihapus. 
        <button type='button'class='btn-close' data-bs-dismiss='alert'aria-label='Close'></button></div>";
    }
}
/**
* Memuat data anggota
*/
if ($q == "")
    {
        $sql_select_anggota = "SELECT * FROM anggota";
    }
else
    {
        $sql_select_anggota = "SELECT * FROM anggota WHERE kode_anggota='".$q."' OR nama_anggota LIKE '%".$q."%'";
    }
$kueri_select_anggota = $koneksi_db->query($sql_select_anggota);
$jumlah_data = $kueri_select_anggota->num_rows;
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
    <h3>Daftar Anggota</h3>
<?php
/**
* Menampilkan data
*/
if ($jumlah_data == 0)
{
?>
<div class="alert alert-warning" role="alert"> Tidak ditemukan data yang sesuai.</div>

<?php
}
else
{
?>
    <form action="?p=anggota" method="post">
        <div class="input-group mb-3">
            <input type="text" name="q" class="form-control" value="<?php echo $q; ?>">
    <button type="submit" name="cmdCari" value="Cari" class="btn btn-info">Cari...</button>
        </div>
    </form>
<table class="table table-striped table-hover">
    <tr>
        <th>#</th>
        <th>Kode Anggota</th>
        <th>Nama Anggota</th>
<?php
if
    (isset($_SESSION["NamaPengguna"]))
    {
?>
    <th>Edit</th>
    <th>Hapus</th>
<?php
    }
?>
</tr>
<?php
$no = 1;
    while ($data_select_anggota = $kueri_select_anggota->fetch_array())

{
echo "<tr>";
echo "<td>".$no."</td>";
echo "<td>".$data_select_anggota["kode_anggota"]."</td>";
echo "<td>".$data_select_anggota["nama_anggota"]."</td>";

if
(isset($_SESSION["NamaPengguna"]))
{
    echo "<td><a href='?p=edit-anggota&id=".$data_select_anggota["id"]."'class='btn btn-warning'>Edit</a></td>";
    echo "<td><form action='?p=anggota' method='post' onsubmit='return confirm(`Apakah Anda yakin menghapus data ini?`)'>
    <input type='hidden' name='hdnID' value='".$data_select_anggota["id"]."'>
    <button type='submit' class='btn btn-danger' name='cmdHapus'value='Hapus'>Hapus</button></form></td>";
}
echo "</tr>"; 
$no++;
}
?> 
</table>

<?php
}
?>

</div>
</div>
</div>