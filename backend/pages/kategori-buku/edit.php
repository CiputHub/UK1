<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

$id = $_GET['KategoriID'];
$q = "SELECT * FROM kategoribuku WHERE KategoriID=$id";
$res = mysqli_query($connect, $q);
$item = mysqli_fetch_assoc($res);
?>
<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Edit Type Kategori</h4>
      <form action="../../action/kategori-buku/update.php" method="POST">
        <input type="hidden" name="KategoriID" value="<?= $item['KategoriID'] ?>">
        <div class="mb-3">
          <label>Nama Kategori</label>
          <input type="text" name="NamaKategori" class="form-control" value="<?= $item['NamaKategori'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="tombol">Edit</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
