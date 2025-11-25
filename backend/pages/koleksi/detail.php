<?php
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['KoleksiID'];
$q = "SELECT k.*, u.NamaLengkap, b.Judul
      FROM koleksipribadi k
      JOIN user u ON k.UserID = u.UserID
      JOIN buku b ON k.BukuID = b.BukuID
      WHERE k.KoleksiID=$id";
$res = mysqli_query($connect, $q);
$item = mysqli_fetch_object($res);
?>

<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Detail Koleksi</div>
    <div class="card-body">
      <table class="table">
        <tr><th>ID</th><td><?= $item->KoleksiID ?></td></tr>
        <tr><th>Nama User</th><td><?= $item->NamaLengkap ?></td></tr>
        <tr><th>Judul Buku</th><td><?= $item->Judul ?></td></tr>
      </table>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
