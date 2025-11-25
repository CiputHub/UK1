<?php
include '../../app.php';

$UserID = $_POST['UserID'];
$BukuID = $_POST['BukuID'];
$TanggalPeminjaman = $_POST['TanggalPeminjaman'];
$TanggalPengembalian = !empty($_POST['TanggalPengembalian']) ? $_POST['TanggalPengembalian'] : NULL;

$q = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
      VALUES ('$UserID', '$BukuID', '$TanggalPeminjaman', " . 
      ($TanggalPengembalian ? "'$TanggalPengembalian'" : "NULL") . ", 'Dipinjam')";

if (mysqli_query($connect, $q)) {
    echo "<script>alert('Data berhasil ditambahkan'); window.location.href='../../pages/peminjaman/index.php';</script>";
} else {
    echo "Error: " . mysqli_error($connect);
}
