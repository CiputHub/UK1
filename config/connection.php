<?php
// 
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'digitalibrary';
//  membuat koneksi ke database
$connect = mysqli_connect($hostname, $username, $password, $database);

// menerima apakah koneksi berhasil atau tidak
if (!$connect) {
    die("koneksi gagal: " . mysqli_connect_error());
}
?>