<?php
session_start();
// Role yang boleh masuk
$allowed_roles = ['administrator', 'peminjam'];

if (!isset($_SESSION['user_logged_in']) || !in_array($_SESSION['user_role'], $allowed_roles)) {
    echo "<script>
        alert('Anda tidak memiliki akses!');
        window.location.href='../dashboard/index.php';
    </script>";
    exit();
}
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'koleksi';
include '../../partials/sidebar.php';

$q = "SELECT k.KoleksiID, u.NamaLengkap, b.Judul 
      FROM koleksipribadi k
      JOIN user u ON k.UserID = u.UserID
      JOIN buku b ON k.BukuID = b.BukuID";
$result = mysqli_query($connect, $q);
?>

<div class="container-fluid mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Koleksi Pribadi</h4>
    <a href="create.php" class="btn btn-primary">Tambah Koleksi</a>
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
          <table id="tabelBuku" class="table table-bordered border-dark text-center align-middle table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Judul Buku</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while($row = $result->fetch_object()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->NamaLengkap ?></td>
            <td><?= $row->Judul ?></td>
            <td>
              <a href="detail.php?KoleksiID=<?= $row->KoleksiID ?>" class="btn btn-success btn-sm">Detail</a>
              <a href="edit.php?id=<?= $row->KoleksiID ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="../../action/koleksi/delete.php?id=<?= $row->KoleksiID ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus koleksi ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
