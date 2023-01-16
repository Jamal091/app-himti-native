<?php
/**
* File koneksi database
*/
/**
* Parameter koneksi server database
*/
$host = "localhost";
$user_db = "root";
$password_user_db = "";
$nama_db = "app_himti_native";

/**
* Membuka koneksi ke server database
*/
$koneksi_db = new mysqli();
$koneksi_db->connect($host, $user_db, $password_user_db,
$nama_db);
?>