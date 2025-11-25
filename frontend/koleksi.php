<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$q = "
    SELECT k.*, b.Judul, b.Penulis, b.Penerbit, b.cover 
    FROM koleksipribadi k
    JOIN buku b ON k.BukuID = b.BukuID
    WHERE k.UserID = $user_id
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koleksi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">⭐ Koleksi Pribadi Saya</h2>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($res)): 
            $cover = !empty($row['cover']) ? "../uploads/cover/" . $row['cover'] : "../uploads/cover/default.jpg";
        ?>
        <div class="col-md-3 col-sm-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="<?= $cover ?>" class="card-img-top" style="height:200px; object-fit:contain;">
                <div class="card-body text-center">
                    <h6 class="card-title"><?= $row['Judul'] ?></h6>
                    <small class="text-muted d-block"><?= $row['Penulis'] ?></small>
                    <small class="text-muted"><?= $row['Penerbit'] ?></small>
                </div>
                <div class="card-footer text-center bg-white">
                    <a href="detail-buku.php?id=<?= $row['BukuID'] ?>" class="btn btn-sm btn-primary">📖 Lihat</a>
                    <a href="koleksi-hapus.php?id=<?= $row['BukuID'] ?>" class="btn btn-sm btn-danger">🗑 Hapus</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
