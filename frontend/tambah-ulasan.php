<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']); // BukuID
$user_id = $_SESSION['user_id'];

// Ambil data buku
$qBuku = "SELECT * FROM buku WHERE BukuID = $id LIMIT 1";
$resBuku = mysqli_query($connect, $qBuku) or die(mysqli_error($connect));
$buku = mysqli_fetch_assoc($resBuku);

if (!$buku) {
    die("Buku tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Ulasan - <?= htmlspecialchars($buku['Judul']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-3 p-4">
        <h3 class="mb-4">✍ Tambah Ulasan untuk <strong><?= htmlspecialchars($buku['Judul']) ?></strong></h3>

        <form action="proses-ulasan.php" method="POST">
            <input type="hidden" name="BukuID" value="<?= $buku['BukuID'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Ulasan Anda</label>
                <textarea name="Ulasan" class="form-control" rows="4" required></textarea>
            </div>

           <div class="mb-3">
    <label class="form-label">Rating</label>
    <div class="star-rating">
        <?php for($i=5; $i>=1; $i--): ?>
            <input type="radio" id="star<?= $i ?>" name="Rating" value="<?= $i ?>" <?= $i==5 ? 'checked' : '' ?> />
            <label for="star<?= $i ?>" title="<?= $i ?> stars">★</label>
        <?php endfor; ?>
    </div>
</div>

<style>
.star-rating {
    direction: rtl;
    font-size: 2rem;
    display: inline-flex;
}
.star-rating input {
    display: none;
}
.star-rating label {
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
}
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #ffc107;
}
</style>


            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">✅ Simpan</button>
                <a href="detail-buku.php?id=<?= $buku['BukuID'] ?>" class="btn btn-outline-secondary px-4">⬅ Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
