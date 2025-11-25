<?php
include '../config/connection.php';
?>
<section id="buku">
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <p class="section-title bg-white text-center text-primary px-3">Koleksi Buku</p>
            <h1 class="display-6 mb-4">Buku Terbaru</h1>
        </div>

        <div class="row g-4">
            <?php
            // Ambil 4 buku terbaru dengan kategori
            $q = "
                SELECT b.BukuID, b.Judul, b.Penulis, b.Stok, b.tahun_terbit, b.cover,
                       k.NamaKategori
                FROM buku b
                LEFT JOIN kategoribuku_relasi kr ON b.BukuID = kr.BukuID
                LEFT JOIN kategoribuku k ON kr.KategoriID = k.KategoriID
                ORDER BY b.BukuID DESC
                LIMIT 4
            ";
            $res = mysqli_query($connect, $q) or die(mysqli_error($connect));

            while ($row = mysqli_fetch_assoc($res)) {
                $cover = !empty($row['cover']) ? "../uploads/cover/" . $row['cover'] : "../uploads/cover/default.jpg";

                // Ambil rata-rata rating untuk buku ini
                $qRating = "SELECT AVG(Rating) AS avgRating FROM ulasanbuku WHERE BukuID=".$row['BukuID'];
                $resRating = mysqli_query($connect, $qRating);
                $ratingData = mysqli_fetch_assoc($resRating);
                $avgRating = round($ratingData['avgRating'] / 20); // ubah 0-100 jadi 0-5 bintang
            ?>
<div class="col-md-3 col-sm-6">
    <div class="card h-100 shadow-sm border-0"
         style="cursor:pointer;"
         onclick="window.location.href='detail-buku.php?id=<?= $row['BukuID'] ?>'">
        <div class="text-center bg-light">
            <img src="<?= $cover ?>" 
                 class="img-fluid" 
                 alt="<?= $row['Judul'] ?>" 
                 style="height: 220px; object-fit: contain; background: #fff;">
        </div>
        <div class="card-body text-center">
            <span class="badge bg-warning text-dark mb-2">
                <?= $row['NamaKategori'] ?? 'Tanpa Kategori' ?>
            </span>
            <h6 class="card-title mb-2"><?= $row['Judul'] ?></h6>
            <small class="text-muted d-block"><strong>Penulis:</strong> <?= $row['Penulis'] ?></small>
            <small class="text-muted d-block"><strong>Stok:</strong> <?= $row['Stok'] ?></small>
            <small class="text-muted"><strong>Tahun:</strong> <?= $row['tahun_terbit'] ?></small>
            
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

        <div class="text-center mt-4">
           <a href="./semua-buku.php" class="btn btn-primary">Lihat Buku Lainnya</a>
        </div>
    </div>
</div>
</section>
