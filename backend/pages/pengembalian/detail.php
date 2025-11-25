<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'pengembalian';
include '../../partials/sidebar.php';

$id = $_GET['id'];
$q = "
    SELECT p.*, u.NamaLengkap, b.Judul 
    FROM pengembalian p
    JOIN peminjaman pm ON p.PeminjamanID = pm.PeminjamanID
    JOIN user u ON pm.UserID = u.UserID
    JOIN buku b ON pm.BukuID = b.BukuID
    WHERE p.PengembalianID='$id'
";
$res = mysqli_query($connect, $q);
$data = mysqli_fetch_assoc($res);
?>
<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Detail Pengembalian</h4>
      <p><strong>Peminjam:</strong> <?= $data['NamaLengkap'] ?></p>
      <p><strong>Buku:</strong> <?= $data['Judul'] ?></p>
      <p><strong>Tanggal Pengembalian:</strong> <?= $data['TanggalPengembalian'] ?></p>
      <p><strong>Kondisi:</strong> <?= ucfirst($data['KondisiBuku']) ?></p>
      <p><strong>Dokumentasi:</strong><br>
        <?php if($data['Dokumentasi']): ?>
          <img src="../../uploads/pengembalian/<?= $data['Dokumentasi'] ?>" width="200">
        <?php else: ?>
          <span class="text-muted">Tidak ada dokumentasi</span>
        <?php endif; ?>
      </p>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
