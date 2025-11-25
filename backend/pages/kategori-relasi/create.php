<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'kategori-relasi';
include '../../partials/sidebar.php';

// ambil semua buku & kategori
$qBuku = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
$qKategori = mysqli_query($connect, "SELECT KategoriID, NamaKategori FROM kategoribuku");
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Type Kategori</h4>
      <form action="../../action/kategori-relasi/store.php" method="POST">
        <div class="mb-3">
          <label>Buku</label>
          <select name="BukuID" class="form-control" required>
            <option value="">-- Pilih Buku --</option>
            <?php while($b = $qBuku->fetch_object()): ?>
              <option value="<?= $b->BukuID ?>"><?= $b->Judul ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Kategori</label>
          <select name="KategoriID" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while($k = $qKategori->fetch_object()): ?>
              <option value="<?= $k->KategoriID ?>"><?= $k->NamaKategori ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <button type="submit" class="btn btn-primary" >Tambah</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
