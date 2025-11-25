<?php
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// ambil hanya user dengan role peminjam
$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user WHERE Role = 'peminjam'");
$qBuku  = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>

<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Tambah Koleksi Pribadi</div>
    <div class="card-body">
      <form action="../../action/koleksi/store.php" method="POST">
        <div class="mb-3">
          <label>User (Peminjam)</label>
          <select name="UserID" class="form-control" required>
            <option value="">-- Pilih Peminjam --</option>
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

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
