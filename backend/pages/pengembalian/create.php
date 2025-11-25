<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'pengembalian';
include '../../partials/sidebar.php';

// ambil data peminjaman untuk pilihan
$qPinjam = "
    SELECT pm.PeminjamanID, u.NamaLengkap, b.Judul 
    FROM peminjaman pm
    JOIN user u ON pm.UserID = u.UserID
    JOIN buku b ON pm.BukuID = b.BukuID
";
$resPinjam = mysqli_query($connect, $qPinjam);
?>
<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah Pengembalian</h4>
      <form action="../../action/pengembalian/store.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label class="form-label">Peminjaman</label>
          <select name="PeminjamanID" class="form-control" required>
            <option value="">-- Pilih Peminjaman --</option>
            <?php while($row = mysqli_fetch_assoc($resPinjam)): ?>
              <option value="<?= $row['PeminjamanID'] ?>">
                <?= $row['NamaLengkap'] ?> - <?= $row['Judul'] ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Pengembalian</label>
          <input type="date" name="TanggalPengembalian" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Kondisi Buku</label>
          <select name="KondisiBuku" class="form-control" required>
            <option value="baik">Baik</option>
            <option value="rusak ringan">Rusak Ringan</option>
            <option value="rusak berat">Rusak Berat</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Dokumentasi</label>
          <input type="file" name="Dokumentasi" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
