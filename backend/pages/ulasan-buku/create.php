<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'ulasan-buku';
include '../../partials/sidebar.php';

// ambil user dan buku
$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user");
$qBuku = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Ulasan</h4>
      <form action="../../action/ulasan/store.php" method="POST">
        <div class="mb-3">
          <label>User</label>
          <select name="UserID" class="form-control" required>
            <option value="">-- Pilih User --</option>
            <?php while($u = $qUsers->fetch_object()): ?>
              <option value="<?= $u->UserID ?>"><?= $u->NamaLengkap ?></option>
            <?php endwhile; ?>
          </select>
        </div>

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
          <label>Ulasan</label>
          <textarea name="Ulasan" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
          <label>Rating (1-100)</label>
          <input type="number" name="Rating" min="1" max="100" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary" name="tombol">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
