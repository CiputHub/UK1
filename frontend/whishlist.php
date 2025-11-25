<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

// Pastikan user sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
$userID = $_SESSION['user_id'] ?? 0;

// Ambil data buku dari koleksi pribadi
$q = "SELECT b.BukuID, b.Judul, b.Penulis, b.Penerbit, b.tahun_terbit, b.cover, k.NamaKategori
      FROM koleksipribadi kp
      JOIN buku b ON kp.BukuID = b.BukuID
      LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
      LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
      WHERE kp.UserID = $userID
      ORDER BY kp.KoleksiID DESC";

$res = mysqli_query($connect, $q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container py-5">
    <div class="mb-3">
        <a href="index.php" class="btn btn-outline-secondary">⬅ Kembali</a>
    </div>

    <h1 class="mb-4">Wishlist Saya</h1>

    <div class="row g-4">
        <?php while($row = mysqli_fetch_assoc($res)): ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0 position-relative">
                <div class="text-center" onclick="window.location.href='detail-buku.php?id=<?= $row['BukuID'] ?>'">
                    <img src="<?= !empty($row['cover']) ? "../uploads/cover/".$row['cover'] : "../uploads/cover/default.jpg" ?>" 
                         class="img-fluid" style="height: 220px; object-fit: contain; background:#fff;">
                </div>
                <div class="card-body text-center">
                    <span class="badge bg-warning text-dark mb-2"><?= $row['NamaKategori'] ?? 'Tanpa Kategori' ?></span>
                    <h6 class="card-title mb-2"><?= $row['Judul'] ?></h6>
                    <small class="text-muted d-block"><strong>Penulis:</strong> <?= $row['Penulis'] ?></small>
                    <small class="text-muted d-block"><strong>Penerbit:</strong> <?= $row['Penerbit'] ?></small>
                    <small class="text-muted"><strong>Tahun:</strong> <?= $row['tahun_terbit'] ?></small>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
