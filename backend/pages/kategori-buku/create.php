<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Type Kategori</h4>
      <form action="../../action/kategori-buku/store.php" method="POST">
        <div class="mb-3">
          <label>Nama Kategori</label>
          <input type="text" name="NamaKategori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary" name="tombol">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
