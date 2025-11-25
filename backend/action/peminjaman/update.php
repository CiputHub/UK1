<?php
include '../../app.php';

$id = $_POST['PeminjamanID'];
$StatusPeminjaman = $_POST['StatusPeminjaman'];
$TanggalPengembalian = !empty($_POST['TanggalPengembalian']) ? $_POST['TanggalPengembalian'] : NULL;

$q = "UPDATE peminjaman 
      SET StatusPeminjaman='$StatusPeminjaman', 
          TanggalPengembalian=" . ($TanggalPengembalian ? "'$TanggalPengembalian'" : "NULL") . " 
      WHERE PeminjamanID=$id";

if (mysqli_query($connect, $q)) {
    echo "<script>alert('Data berhasil diedit'); window.location.href='../../pages/peminjaman/index.php';</script>";
} else {
    echo "<script>alert('Data Gagal diedit'); window.location.href='../../pages/peminjaman/edit.php';</script>" . mysqli_error($connect);
}
