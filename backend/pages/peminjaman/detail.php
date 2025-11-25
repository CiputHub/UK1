<?php
session_name("backendSession");
session_start();
// Role yang boleh masuk
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_role'] != 'petugas') {
    echo "<script>
    alert('Anda tidak memiliki akses!');
    window.location.href='../dashboard/index.php';
    </script>";
    exit();
}


include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'peminjaman';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = "
SELECT p.*, u.NamaLengkap AS nama_user, b.Judul AS judul_buku
FROM peminjaman p
JOIN user u ON p.UserID = u.UserID
JOIN buku b ON p.BukuID = b.BukuID
WHERE p.PeminjamanID=$id";
$res = mysqli_query($connect, $q);
$data = mysqli_fetch_assoc($res);
?>

<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Detail Peminjaman</div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr><th>Nama User</th><td><?= $data['nama_user'] ?></td></tr>
        <tr><th>Judul Buku</th><td><?= $data['judul_buku'] ?></td></tr>
        <tr><th>Tanggal Pinjam</th><td><?= $data['TanggalPeminjaman'] ?></td></tr>
        <tr><th>Tanggal Kembali</th><td><?= $data['TanggalPengembalian'] ?: '-' ?></td></tr>
        <tr><th>Status</th><td><?= $data['StatusPeminjaman'] ?></td></tr>
      </table>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
