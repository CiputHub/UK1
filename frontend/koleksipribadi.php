<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['user_id'];

$q = "
    SELECT b.BukuID, b.Judul, b.Penulis, b.Penerbit, b.tahun_terbit, b.cover, k.NamaKategori
    FROM koleksipribadi kp
    JOIN buku b ON kp.BukuID = b.BukuID
    LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
    LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
    WHERE kp.UserID = $userID
    ORDER BY kp.KoleksiID DESC
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koleksi Pribadi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<div class="container py-5">

  <!-- Tombol Kembali -->
  <div class="mb-3">
    <a href="index.php" class="btn btn-outline-secondary">⬅ Kembali</a>
  </div>

  <!-- Judul Halaman -->
  <div class="text-center mb-4">
    <h1 class="display-6">Koleksi Pribadi</h1>
    <p class="text-muted">Buku yang kamu simpan di koleksi pribadi</p>
  </div>

  <div class="row g-4">
    <?php if (mysqli_num_rows($res) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($res)): 
        $cover = !empty($row['cover']) ? "../uploads/cover/" . $row['cover'] : "../uploads/cover/default.jpg";
      ?>
        <div class="col-md-3 col-sm-6">
          <div class="card h-100 shadow-sm border-0 position-relative">
            <!-- Icon hapus koleksi -->
            <span class="position-absolute top-0 end-0 m-2 fs-5 text-primary" 
                  style="cursor:pointer;" 
                  onclick="toggleKoleksi(event, <?= $row['BukuID'] ?>)">
              <i class="bi bi-bookmark-fill"></i>
            </span>

            <div class="text-center" onclick="window.location.href='detail-buku.php?id=<?= $row['BukuID'] ?>'">
              <img src="<?= $cover ?>" class="img-fluid" style="height:220px; object-fit:contain; background:#fff;">
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
    <?php else: ?>
      <div class="col-12 text-center">
        <p class="text-muted">Belum ada buku di koleksi pribadimu.</p>
      </div>
    <?php endif; ?>
  </div>
</div>

<script>
function toggleKoleksi(event, bukuID) {
    event.stopPropagation();

    fetch('toggle_koleksi.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'buku_id=' + bukuID
    })
    .then(res => res.json())
    .then(data => {
        if (data.success && !data.inKoleksi) {
            // kalau dihapus → langsung hilang dari halaman
            event.target.closest('.col-md-3').remove();
        }
    })
    .catch(err => console.error('Fetch error:', err));
}
</script>

</body>
</html>
