<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data peminjaman user
$q = "
    SELECT p.*, b.Judul, b.Penulis, b.cover 
    FROM peminjaman p
    JOIN buku b ON p.BukuID = b.BukuID
    WHERE p.UserID = $user_id
    ORDER BY p.PeminjamanID DESC
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4">📖 Riwayat Peminjaman Saya</h2>

  <?php if (mysqli_num_rows($res) == 0): ?>
    <div class="alert alert-info">Belum ada peminjaman buku.</div>
  <?php else: ?>
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($res)): ?>
          <tr>
            <td style="width:80px">
              <img src="../uploads/cover/<?= $row['cover'] ?: 'default.jpg' ?>" 
                   class="img-fluid rounded" style="max-height:70px">
            </td>
            <td><?= htmlspecialchars($row['Judul']) ?></td>
            <td><?= htmlspecialchars($row['Penulis']) ?></td>
            <td><?= htmlspecialchars($row['TanggalPeminjaman']) ?></td>
            <td><?= htmlspecialchars($row['TanggalPengembalian']) ?></td>
            <td>
              <?php if ($row['StatusPeminjaman'] == 'dipinjam'): ?>
                <span class="badge bg-warning text-dark">Dipinjam</span>
              <?php else: ?>
                <span class="badge bg-success">Dikembalikan</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <div class="mt-4">
    <a href="detail-buku.php" class="btn btn-secondary">⬅ Kembali ke Beranda</a>
  </div>
</div>

</body>
</html>
