<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

// ambil semua ulasan join dengan user + buku
$q = "
  SELECT ub.*, b.Judul, us.NamaLengkap 
  FROM ulasanbuku ub
  JOIN buku b ON ub.BukuID = b.BukuID
  JOIN user us ON ub.UserID = us.UserID
  ORDER BY ub.UlasanID DESC
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Semua Ulasan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4 text-center">📖 Semua Ulasan Buku</h2>

  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($res)): 
        $stars = round($row['rating'] / 20); // 0-100 → 0-5 bintang
    ?>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 rounded-3 h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['Judul']) ?></h5>
            <p class="text-muted mb-1">👤 <?= htmlspecialchars($row['NamaLengkap']) ?></p>
            
            <!-- Rating Bintang -->
            <p class="mb-2">
              <?php
                for($i=1; $i<=5; $i++){
                    if($i <= $stars){
                        echo '<span style="color:#FFD700; font-size:1.2em;">★</span>';
                    } else {
                        echo '<span style="color:#ccc; font-size:1.2em;">★</span>';
                    }
                }
              ?>
            </p>

            <p class="mb-2">💬 <?= nl2br(htmlspecialchars($row['Ulasan'])) ?></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
  </div>
</div>

</body>
</html>
