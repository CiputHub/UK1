<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

// Cek login (misalnya session user_id)
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login dulu untuk meminjam buku'); window.location.href='login.php';</script>";
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$buku_id = intval($_GET['id']);

// Insert peminjaman
$tanggalPinjam = date("Y-m-d");
$tanggalKembali = date("Y-m-d", strtotime("+7 days")); // default 7 hari

$q = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
      VALUES ($user_id, $buku_id, '$tanggalPinjam', '$tanggalKembali', 'dipinjam')";
if (mysqli_query($connect, $q)) {
    echo "<script>alert('Buku berhasil dipinjam'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Gagal meminjam buku'); window.location.href='detail-buku.php?id=$buku_id';</script>";
}
?>
