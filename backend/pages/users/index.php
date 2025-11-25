<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'users';
include '../../partials/sidebar.php';

// --- Pagination setup ---
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$qCount = "SELECT COUNT(*) AS total FROM user";
$resCount = mysqli_query($connect, $qCount);
$totalData = mysqli_fetch_assoc($resCount)['total'];
$totalPages = ceil($totalData / $limit);


$q = "SELECT * FROM user LIMIT $limit OFFSET $offset";
$result = mysqli_query($connect, $q);
?>

<div class="container-fluid mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data User</h4>
    <a href="create.php" class="btn btn-primary">Tambah User</a>
  </div>

  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <table id="tabelBuku" class="table table-bordered border-dark text-center align-middle table-striped">
                <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
           <?php $no = $offset + 1;
            while($row = $result->fetch_object()): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->Username ?></td>
            <td><?= $row->Email ?></td>
            <td><?= $row->NamaLengkap ?></td>
            <td><?= $row->Role ?></td>
          <td>
            <!-- <a href="./detail.php?UserID=<?= $row->UserID ?>" class="btn btn-success btn-sm">Detail</a> -->
            <a href="./edit.php?UserID=<?= $row->UserID ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="../../action/users/delete.php?UserID=<?= $row->UserID ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
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
