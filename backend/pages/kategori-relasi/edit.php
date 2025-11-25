<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'kategori-relasi';
include '../../partials/sidebar.php';

$id = $_GET['KategoriBukuID'];
$q = "SELECT * FROM kategoribuku_relasi WHERE KategoriBukuID=$id";
$res = mysqli_query($connect, $q);
$item = mysqli_fetch_assoc($res);

$qBuku = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
$qKategori = mysqli_query($connect, "SELECT KategoriID, NamaKategori FROM kategoribuku");
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Type Kategori</h4>
      <form action="../../action/kategori-relasi/update.php" method="POST">
        <input type="hidden" name="KategoriBukuID" value="<?= $item['KategoriBukuID'] ?>">

        <div class="mb-3">
          <label>Buku</label>
          <select name="BukuID" class="form-control" required>
            <?php while($b = $qBuku->fetch_object()): ?>
              <option value="<?= $b->BukuID ?>" <?= $item['BukuID']==$b->BukuID ? 'selected' : '' ?>>
                <?= $b->Judul ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Kategori</label>
          <select name="KategoriID" class="form-control" required>
            <?php while($k = $qKategori->fetch_object()): ?>
              <option value="<?= $k->KategoriID ?>" <?= $item['KategoriID']==$k->KategoriID ? 'selected' : '' ?>>
                <?= $k->NamaKategori ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary" name="tombol">Edit</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
