<?php
session_name("backendSession");
session_start();

// Role yang boleh masuk
$allowed_roles = ['administrator', 'peminjam'];

if (!isset($_SESSION['user_logged_in']) || !in_array($_SESSION['user_role'], $allowed_roles)) {
    echo "<script>
        alert('Anda tidak memiliki akses!');
        window.location.href='../dashboard/index.php';
    </script>";
    exit();




    // Anti-back + cek login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('Silakan login terlebih dahulu!');
        window.location.href='../user/login.php';
    </script>";
    exit();
}

// Untuk mencegah back browser
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

}
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'ulasan-buku';
include '../../partials/sidebar.php';

// --- Pagination setup ---
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$qCount = "SELECT COUNT(*) AS total FROM ulasanbuku";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);

// JOIN supaya dapat nama user & judul buku
$qUlasan = "
    SELECT u.UlasanID, us.NamaLengkap AS NamaUser, b.Judul AS JudulBuku, 
           u.Ulasan, u.Rating
    FROM ulasanbuku u
    LEFT JOIN user us ON u.UserID = us.UserID
    LEFT JOIN buku b ON u.BukuID = b.BukuID
";
$result = mysqli_query($connect, $qUlasan) or die(mysqli_error($connect));

?>

<div class="container-fluid mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Tabel Ulasan</h4>
    <!-- <a href="./create.php" class="btn btn-primary">Tambah</a> -->
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
        <table id="tabelBuku" class="table table-bordered border-dark text-center align-middle table-striped">
            <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Judul Buku</th>
          
            <th>Rating</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = $offset + 1;
          while($item = $result->fetch_object()): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($item->NamaUser) ?></td>
              <td><?= htmlspecialchars($item->JudulBuku) ?></td>
           
              <td><?= $item->Rating ?>/100</td>
              <td>

                <a href="./detail.php?id=<?= $item->UlasanID ?>" class="btn btn-success btn-sm">Detail</a>
                <!-- <a href="./edit.php?id=<?= $item->UlasanID ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="../../action/ulasan/delete.php?id=<?= $item->UlasanID ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus ulasan ini?')">Hapus</a> -->

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

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
