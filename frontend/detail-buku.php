<?php
session_name("frontend_session");
session_start(); 
include '../config/connection.php';


if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);
$q = "
    SELECT b.*, k.NamaKategori
    FROM buku b
    LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
    LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
    WHERE b.BukuID = $id
    LIMIT 1
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
$buku = mysqli_fetch_assoc($res);


if (!$buku) {
    echo "Buku tidak ditemukan.";
    exit;
}

$cover = !empty($buku['cover']) ? "../uploads/cover/" . $buku['cover'] : "../uploads/cover/default.jpg";
$deskripsi = !empty($buku['deskripsi']) ? $buku['deskripsi'] : "Belum ada deskripsi untuk buku ini.";

// Ambil rata-rata rating buku
$qRating = "SELECT AVG(Rating) AS avgRating FROM ulasanbuku WHERE BukuID=".$buku['BukuID'];
$resRating = mysqli_query($connect, $qRating);
$ratingData = mysqli_fetch_assoc($resRating);
$avgRating = round($ratingData['avgRating'] / 20); // 0-100 → 0-5 bintang




?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($buku['Judul']) ?> - Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body class="bg-light">

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        ✅ Peminjaman berhasil disimpan!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'max'): ?>
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        ❌ Kamu sudah mencapai batas maksimal 3 buku yang sedang dipinjam.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-3 p-4">
        <div class="row g-4 align-items-center">
            <!-- Cover -->
            <div class="col-md-4 text-center">
                <img src="<?= $cover ?>" 
                     alt="<?= htmlspecialchars($buku['Judul']) ?>" 
                     class="img-fluid shadow-sm rounded-3 border"
                     style="max-height: 420px; object-fit: contain; background:#fff;">
            </div>

            <!-- Info -->
            <div class="col-md-8">
                <h2 class="fw-bold mb-3"><?= htmlspecialchars($buku['Judul']) ?></h2>
                <span class="badge bg-primary mb-3 fs-6 px-3 py-2">
                    <?= $buku['NamaKategori'] ?? 'Tanpa Kategori' ?>
                </span>

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">
                        <strong>📖 Penulis:</strong> <?= $buku['Penulis'] ?>
                    </li>
                    <li class="list-group-item">
                        <strong>🏢 Penerbit:</strong> <?= $buku['Penerbit'] ?>
                    </li>
                    <li class="list-group-item">
                        <strong>📅 Tahun Terbit:</strong> <?= $buku['tahun_terbit'] ?>
                    </li>

                    <li class="list-group-item">
                        <strong>📦 Stok:</strong> <?= $buku['Stok'] ?>
                    </li>

                    <li class="list-group-item">
                       <strong>⭐ Rating:</strong>
    <?php
    for($i=1; $i<=5; $i++){
        if($i <= $avgRating){
            echo '<span style="color:#FFD700; font-size:1.2em;">★</span>';
        } else {
            echo '<span style="color:#ccc; font-size:1.2em;">★</span>';
        }
    }
    ?>
                    </li>
                   
                </ul>

                
    


                <!-- Deskripsi / Sinopsis -->
<div class="card mt-4 border-0 shadow-sm">
  <div class="card-body">
    <h5 class="fw-bold mb-3">📚 Deskripsi / Sinopsis</h5>
    
    <p id="deskripsiText" class="text-muted" style="overflow:hidden; max-height:100px;">
      <?= nl2br(htmlspecialchars($deskripsi)) ?>
    </p>

    <button id="toggleDeskripsi" class="btn btn-link p-0">Baca Selengkapnya ⬇</button>
  </div>
</div>

                

                <div class="d-flex gap-3 mt-4">
             <?php if (isset($_SESSION['user_id'])): ?>
    <?php if($buku['Stok'] > 0): ?>
        <a href="./pinjam.php?id=<?= $buku['BukuID'] ?>" class="btn btn-outline-success btn-lg">📚 Pinjam Buku</a>
    <?php else: ?>
        <button class="btn btn-outline-secondary btn-lg" disabled>❌ Stok Habis</button>
    <?php endif; ?>
    <a href="tambah-ulasan.php?id=<?= $buku['BukuID'] ?>" class="btn btn-outline-warning btn-lg">✍ Tambah Ulasan</a>
    <a href="riwayat-peminjaman.php?id=<?= $buku['BukuID'] ?>" class="btn btn-outline-primary btn-lg">📚 Lihat Riwayat</a>
<?php else: ?>
    <!-- Kalau belum login -->
    <button class="btn btn-outline-success" onclick="showLoginWarning()" <?= $buku['Stok']==0 ? 'disabled' : '' ?>>📚 Pinjam Buku</button>
    <button class="btn btn-outline-warning" onclick="showLoginWarning()">✍ Tambah Ulasan</button>
    <button class="btn btn-outline-primary" onclick="showLoginWarning()">📚 Lihat Riwayat</button>
<?php endif; ?>


                    <a href="index.php" class="btn btn-outline-secondary btn-lg">
                        ⬅ Kembali
                    </a>
                </div>
    <?php
// Cek apakah buku sudah ada di koleksi user
$userID = $_SESSION['user_id'] ?? 0;
$qKoleksi = "SELECT * FROM koleksipribadi WHERE UserID=$userID AND BukuID=".$buku['BukuID'];
$resKoleksi = mysqli_query($connect, $qKoleksi);
$inKoleksi = mysqli_num_rows($resKoleksi) > 0; // TRUE kalau sudah tersimpan
?>
<!-- <span id="koleksiIcon" class="fs-4" style="cursor:pointer; color:<?= $inKoleksi ? 'blue' : 'black' ?>;">
    <i class="bi bi-bookmark<?= $inKoleksi ? '-fill' : '' ?>"></i>
</span> -->



                    <!-- <a href="index.php" class="btn btn-outline-secondary btn-lg">
                        ⬅ Kembali
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const deskripsiText = document.getElementById("deskripsiText");
const toggleBtn = document.getElementById("toggleDeskripsi");
let expanded = false;

toggleBtn.addEventListener("click", function() {
    if (!expanded) {
        deskripsiText.style.maxHeight = "none";  // buka penuh
        toggleBtn.textContent = "Tutup ⬆";
        expanded = true;
    } else {
        deskripsiText.style.maxHeight = "100px"; // balik ke singkat
        toggleBtn.textContent = "Baca Selengkapnya ⬇";
        expanded = false;
    }
});
</script>


<script>
const bukuID = <?= $buku['BukuID'] ?>;
const icon = document.getElementById('koleksiIcon').querySelector('i');

document.getElementById('koleksiIcon').addEventListener('click', ()=>{
    fetch('proses-koleksi.php', {
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:'BukuID='+bukuID
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.status=='added'){
            icon.classList.replace('bi-bookmark','bi-bookmark-fill');
            icon.style.color = 'blue';
        } else {
            icon.classList.replace('bi-bookmark-fill','bi-bookmark');
            icon.style.color = 'black';
        }
    });
});
</script>



 
<!-- <button onclick="showLoginWarning()" class="btn btn-primary">Coba Klik</button> -->

<!-- Modal Login/Register Global -->
<div class="modal fade" id="loginWarning" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header">
        <h5 class="modal-title">⚠️ Akses Dibatasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p>Anda harus <strong>Login</strong> atau <strong>Register</strong> terlebih dahulu untuk menggunakan fitur ini.</p>
      </div>
      <div class="modal-footer justify-content-center">
        <a href="./auth/login.php" class="btn btn-primary">🔑 Login</a>
        <a href="./auth/register.php" class="btn btn-success">📝 Register</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS wajib -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function showLoginWarning() {
    const modal = new bootstrap.Modal(document.getElementById('loginWarning'));
    modal.show();
}
</script>


</body>
</html>


