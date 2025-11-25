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
include '../../partials/sidebar.php';

// ambil user & buku
$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user");
$qBuku = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>

<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Tambah Peminjaman</div>
    <div class="card-body">
      <form action="../../action/peminjaman/store.php" method="POST">
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
          <label>Tanggal Pinjam</label>
          <input type="date" name="TanggalPeminjaman" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Tanggal Kembali</label>
          <input type="date" name="TanggalPengembalian" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
