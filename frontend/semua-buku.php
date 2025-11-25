<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

$catRes = mysqli_query($connect, "SELECT * FROM kategoribuku ORDER BY NamaKategori ASC");
$selectedCat = $_GET['kategori'] ?? '';

$q = "SELECT b.BukuID, b.Judul, b.Penulis, b.Penerbit, b.tahun_terbit, b.cover, k.NamaKategori
      FROM buku b
      LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
      LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
      WHERE 1";

if(!empty($selectedCat)){
    $q .= " AND k.KategoriID = ".intval($selectedCat);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Buku</title>
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
        <h1 class="display-6">Koleksi Semua Buku</h1>
        <p class="text-muted">Daftar lengkap koleksi buku perpustakaan</p>
    </div>

    
   <div class="row mb-4 g-2 align-items-center">
    <!-- Search Box -->
    <div class="col-md-8 col-sm-12">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari buku: judul, penulis, penerbit...">
    </div>

    <!-- Dropdown Kategori -->
    <div class="col-md-4 col-sm-12">
        <select name="kategori" id="kategoriSelect" class="form-select">
            <option value="">Semua Kategori</option>
            <?php
            mysqli_data_seek($catRes, 0); // reset pointer agar bisa loop lagi
            while($cat = mysqli_fetch_assoc($catRes)):
            ?>
                <option value="<?= $cat['KategoriID'] ?>" <?= ($selectedCat==$cat['KategoriID'])?'selected':'' ?>>
                    <?= $cat['NamaKategori'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
</div>


    <!-- Container Grid Buku -->
    <div id="bukuContainer" class="row g-4">
        <?php
  $q = "
    SELECT b.BukuID, b.Judul, b.Penulis, b.Penerbit, b.tahun_terbit, b.cover,
           k.NamaKategori
    FROM buku b
    LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
    LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
    ORDER BY b.BukuID DESC
";


       $res = mysqli_query($connect, $q) or die(mysqli_error($connect));

while ($row = mysqli_fetch_assoc($res)) {
    $cover = !empty($row['cover']) ? "../uploads/cover/" . $row['cover'] : "../uploads/cover/default.jpg";
    $userID = $_SESSION['user_id'] ?? 0;
    $qKoleksi = "SELECT * FROM koleksipribadi WHERE UserID=$userID AND BukuID=".$row['BukuID'];
    $resKoleksi = mysqli_query($connect, $qKoleksi);
    $inKoleksi = mysqli_num_rows($resKoleksi) > 0;

    // Ambil rata-rata rating untuk buku ini
    $qRating = "SELECT AVG(Rating) AS avgRating FROM ulasanbuku WHERE BukuID=".$row['BukuID'];
    $resRating = mysqli_query($connect, $qRating);
    $ratingData = mysqli_fetch_assoc($resRating);
    $avgRating = round($ratingData['avgRating'] / 20); // 0-100 jadi 0-5 bintang
        ?>
       <div class="col-md-3 col-sm-6">
    <div class="card h-100 shadow-sm border-0 position-relative">
        <!-- Icon Simpan Koleksi -->
        <span class="position-absolute top-0 end-0 m-2 fs-5 text-primary" 
              style="cursor:pointer;" 
              onclick="toggleKoleksi(event, <?= $row['BukuID'] ?>)">
            <i class="bi bi-bookmark<?= $inKoleksi ? '-fill' : '' ?>"></i>
        </span>

        <div class="text-center" onclick="window.location.href='detail-buku.php?id=<?= $row['BukuID'] ?>'">
            <img src="<?= $cover ?>" class="img-fluid" style="height: 220px; object-fit: contain; background:#fff;">
        </div>
        <div class="card-body text-center">
            <span class="badge bg-warning text-dark mb-2"><?= $row['NamaKategori'] ?? 'Tanpa Kategori' ?></span>
            <h6 class="card-title mb-2"><?= $row['Judul'] ?></h6>
            <small class="text-muted d-block"><strong>Penulis:</strong> <?= $row['Penulis'] ?></small>
         <small class="text-muted d-block"><strong>Stok:</strong> <?= $row['Stok'] ?></small>
            <small class="text-muted d-block"><strong>Tahun:</strong> <?= $row['tahun_terbit'] ?></small>
            
              <!-- Rating Bintang -->
    <p class="mt-2 mb-0">
        <?php
        for($i=1; $i<=5; $i++){
            if($i <= $avgRating){
                echo '<span style="color:#FFD700; font-size:1.1em;">★</span>';
            } else {
                echo '<span style="color:#ccc; font-size:1.1em;">★</span>';
            }
        }
        ?>
    </p>
</div>
    </div>
</div>
        <?php } ?>
    </div>
</div>

<script>
function toggleKoleksi(event, bukuID) {
    event.stopPropagation(); // biar ga ikut klik detail

    fetch('toggle_koleksi.php', { // path relatif ke semua-buku.php
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'buku_id=' + bukuID
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            const icon = event.target.closest('i');
            if (data.inKoleksi) {
                icon.classList.remove('bi-bookmark');
                icon.classList.add('bi-bookmark-fill');
                icon.classList.add('text-primary'); // kasih warna biru
            } else {
                icon.classList.remove('bi-bookmark-fill');
                icon.classList.remove('text-primary');
                icon.classList.add('bi-bookmark');
            }
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error('Fetch error:', err));
}
</script>



<script>
const searchInput = document.getElementById('searchInput');
const bukuContainer = document.getElementById('bukuContainer');
const kategoriSelect = document.querySelector('select[name="kategori"]');

function loadBuku() {
    const query = searchInput.value;
    const kategori = kategoriSelect.value;

    fetch('search-buku.php?q=' + encodeURIComponent(query) + '&kategori=' + encodeURIComponent(kategori))
        .then(res => res.text())
        .then(html => {
            bukuContainer.innerHTML = html;
        });
}

// Trigger search saat mengetik
searchInput.addEventListener('input', loadBuku);

// Trigger search saat ganti kategori
kategoriSelect.addEventListener('change', loadBuku);

// Load awal
loadBuku();

</script>


</body>
</html>
