<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$buku_id = $_GET['id'] ?? null;

if (!$buku_id) {
    header("Location: buku.php");
    exit;
}

// Ambil data user
$qUser = "SELECT * FROM user WHERE UserID = $user_id LIMIT 1";
$resUser = mysqli_query($connect, $qUser);
$user = mysqli_fetch_assoc($resUser);

// Ambil data buku
$qBuku = "SELECT * FROM buku WHERE BukuID = $buku_id LIMIT 1";
$resBuku = mysqli_query($connect, $qBuku);
$buku = mysqli_fetch_assoc($resBuku);

// Cek stok buku
if ($buku['Stok'] <= 0) {
    header("Location: detail-buku.php?id=$buku_id&error=stok");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tgl_pinjam = $_POST['TanggalPeminjaman'];
    $tgl_kembali = $_POST['TanggalPengembalian'];

    // Cek jumlah pinjaman aktif
    $qCek = "SELECT COUNT(*) AS total 
             FROM peminjaman 
             WHERE UserID = $user_id AND StatusPeminjaman = 'dipinjam'";
    $resCek = mysqli_query($connect, $qCek);
    $dataCek = mysqli_fetch_assoc($resCek);

    if ($dataCek['total'] >= 3) {
        header("Location: detail-buku.php?id=$buku_id&error=max");
        exit;
    }

    // Simpan peminjaman
$qInsert = "INSERT INTO peminjaman 
            (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) 
            VALUES ($user_id, $buku_id, '$tgl_pinjam', '$tgl_kembali', 'dipinjam')";
mysqli_query($connect, $qInsert) or die(mysqli_error($connect));

// Kurangi stok buku
$qUpdateStok = "UPDATE buku SET Stok = Stok - 1 WHERE BukuID = $buku_id AND Stok > 0";
mysqli_query($connect, $qUpdateStok);

    header("Location: detail-buku.php?id=$buku_id&success=1");
    exit;
}

// Default tanggal
$tglPinjamDefault = date("Y-m-d");
$tglKembaliDefault = date("Y-m-d", strtotime("+7 days"));


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku - <?= htmlspecialchars($buku['Judul']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-3 p-4">
        <h3 class="mb-4">📚 Form Peminjaman Buku</h3>

        <!-- Info Buku -->
<div class="mb-3">
    <strong>Judul Buku:</strong> <?= htmlspecialchars($buku['Judul']) ?><br>
    <strong>Penulis:</strong> <?= htmlspecialchars($buku['Penulis']) ?><br>
    <strong>Stok Tersedia:</strong> <?= $buku['Stok'] ?> <?= $buku['Stok']==0 ? "(Habis)" : "" ?>
</div>

        <!-- Info User -->
        <div class="mb-3">
            <strong>Peminjam:</strong> <?= htmlspecialchars($user['NamaLengkap']) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($user['Email']) ?>
        </div>
        

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="TanggalPeminjaman" class="form-control" value="<?= $tglPinjamDefault ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Kembali</label>
                    <input type="date" name="TanggalPengembalian" class="form-control" value="<?= $tglKembaliDefault ?>" required>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
    <?php if($buku['Stok'] > 0): ?>
        <button type="submit" class="btn btn-success btn-lg">✅ Simpan Peminjaman</button>
    <?php else: ?>
        <button type="button" class="btn btn-secondary btn-lg" disabled>📦 Stok Habis</button>
    <?php endif; ?>
    <a href="detail-buku.php?id=<?= $buku_id ?>" class="btn btn-outline-secondary btn-lg">⬅ Kembali</a>
</div>
        </form>
    </div>
</div>

</body>
</html>
