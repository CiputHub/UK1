<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

$kategori = $_GET['kategori'] ?? '';

$q = "SELECT b.BukuID, b.Judul, b.Penulis, b.Stok, b.tahun_terbit, b.cover,
             k.NamaKategori
      FROM buku b
      LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
      LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
      WHERE 1";

if(!empty($_GET['q'])){
    $search = mysqli_real_escape_string($connect, $_GET['q']);
    $q .= " AND (
        b.Judul LIKE '%$search%' 
        OR b.Penulis LIKE '%$search%' 
        OR b.Stok LIKE '%$search%'
        OR b.tahun_terbit LIKE '%$search%'
        OR k.NamaKategori LIKE '%$search%'
    )";
}

if(!empty($kategori)){
    $q .= " AND k.KategoriID = ".intval($kategori);
}

$q .= " ORDER BY b.BukuID DESC";

$res = mysqli_query($connect, $q) or die(mysqli_error($connect));

while($row = mysqli_fetch_assoc($res)){
    $cover = !empty($row['cover']) ? "../uploads/cover/".$row['cover'] : "../uploads/cover/default.jpg";
    $userID = $_SESSION['user_id'] ?? 0;
    $qKoleksi = "SELECT * FROM koleksipribadi WHERE UserID=$userID AND BukuID=".$row['BukuID'];
    $resKoleksi = mysqli_query($connect, $qKoleksi);
    $inKoleksi = mysqli_num_rows($resKoleksi) > 0;

    // Ambil rata-rata rating buku
    $qRating = "SELECT AVG(Rating) AS avgRating FROM ulasanbuku WHERE BukuID=".$row['BukuID'];
    $resRating = mysqli_query($connect, $qRating);
    $ratingData = mysqli_fetch_assoc($resRating);
    $avgRating = round($ratingData['avgRating'] / 20); // 0-100 → 0-5 bintang
?>

<div class="col-md-3 col-sm-6">
    <div class="card h-100 shadow-sm border-0 position-relative">
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

<?php
}
?>
