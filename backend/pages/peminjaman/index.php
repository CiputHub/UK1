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


// --- Pagination setup ---
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$qCount = "SELECT COUNT(*) AS total FROM peminjaman";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);

$q = "
SELECT p.*, u.NamaLengkap AS nama_user, b.Judul AS judul_buku
FROM peminjaman p
JOIN user u ON p.UserID = u.UserID
JOIN buku b ON p.BukuID = b.BukuID
ORDER BY p.PeminjamanID DESC
";
$result = mysqli_query($connect, $q);
?>

<div class="container-fluid mt-3">
  <div class="d-flex justify-content-between mb-3">
    <h4>Data Peminjaman</h4>
    <a href="create.php" class="btn btn-primary">Tambah</a>
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
        <table id="tabelBuku" class="table table-bordered border-dark text-center align-middle table-striped">
          <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>User</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
         <?php $no = $offset + 1;
          while($row = $result->fetch_object()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->nama_user ?></td>
            <td><?= $row->judul_buku ?></td>
            <td><?= $row->TanggalPeminjaman ?></td>
            <td><?= $row->TanggalPengembalian ?: '-' ?></td>
            <td><?= $row->StatusPeminjaman ?></td>
            <td>
              <!-- <a href="detail.php?id=<?= $row->PeminjamanID ?>" class="btn btn-success btn-sm">Detail</a> -->
              <a href="edit.php?id=<?= $row->PeminjamanID ?>" class="btn btn-warning btn-sm">Edit</a>
              <!-- <a href="../../action/peminjaman/delete.php?id=<?= $row->PeminjamanID ?>" 
                 class="btn btn-danger btn-sm" 
                 onclick="return confirm('Yakin hapus data ini?')">Hapus</a> -->
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page-1 ?>">Previous</a>
          </li>

          <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>

          <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page+1 ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<?php include '../../partials/footer.php'; include '../../partials/script.php'; ?>
