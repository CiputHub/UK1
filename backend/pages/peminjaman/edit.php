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
$q = "SELECT * FROM peminjaman WHERE PeminjamanID=$id";
$res = mysqli_query($connect, $q);
$peminjaman = mysqli_fetch_assoc($res);

$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user");
$qBuku = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>

<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Edit Peminjaman</div>
    <div class="card-body">
      <form action="../../action/peminjaman/update.php" method="POST">
        <input type="hidden" name="PeminjamanID" value="<?= $peminjaman['PeminjamanID'] ?>">

        <div class="mb-3">
          <label>Status</label>
          <select name="StatusPeminjaman" class="form-control">
            <option value="Dipinjam" <?= $peminjaman['StatusPeminjaman']=='Dipinjam'?'selected':'' ?>>Dipinjam</option>
            <option value="Dikembalikan" <?= $peminjaman['StatusPeminjaman']=='Dikembalikan'?'selected':'' ?>>Dikembalikan</option>
          </select>
        </div>
        <div class="mb-3">
          <label>Tanggal Kembali</label>
          <input type="date" name="TanggalPengembalian" class="form-control" value="<?= $peminjaman['TanggalPengembalian'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
