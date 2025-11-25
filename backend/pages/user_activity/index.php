<?php
session_start();
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../app.php';

// Cek login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: ../user/login.php");
    exit;
}

$current_dir = 'user_activity';

// Ambil semua riwayat aktivitas
$qHistory = "SELECT ua.*, u.name, u.role 
             FROM user_activity ua
             JOIN users u ON ua.user_id = u.id
             ORDER BY ua.activity_time DESC";
$result = mysqli_query($connect, $qHistory);
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-white fw-bold">
      Semua Aktivitas User
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Role</th>
              <th>Aktivitas</th>
              <th>Deskripsi</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['role'] ?></td>
                <td><?= ucfirst($row['activity']) ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['activity_time'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
