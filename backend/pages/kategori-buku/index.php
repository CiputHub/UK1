<?php
session_name("backendSession");
session_start();

// Anti-back + cek login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'kategori-buku';
include '../../partials/sidebar.php';

// --- Pagination setup ---
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$qCount = "SELECT COUNT(*) AS total FROM kategoribuku";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data sesuai halaman
$q = "SELECT * FROM kategoribuku LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $q);
?>

<div class="container-fluid mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Type Kategori</h4>
    <a href="create.php" class="btn btn-primary">Tambah</a>
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <table class="table table-bordered border-dark text-center align-middle table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $no = $offset + 1;
          while($row = $result->fetch_object()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->NamaKategori ?></td>
            <td>
              <a href="edit.php?KategoriID=<?= $row->KategoriID ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="../../action/kategori-buku/delete.php?KategoriID=<?= $row->KategoriID ?>" 
                 class="btn btn-danger btn-sm" 
                 onclick="return confirm('Yakin hapus kategori ini?')">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

      <!-- Pagination -->
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

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
