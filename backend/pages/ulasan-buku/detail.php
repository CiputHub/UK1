<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'ulasan-buku';
include '../../partials/sidebar.php';

$id = $_GET['id']; // pastikan index.php link pakai ?id=...

$q = "
SELECT u.*, us.NamaLengkap AS nama_user, b.Judul AS judul_buku
FROM ulasanbuku u
JOIN user us ON u.UserID = us.UserID
JOIN buku b ON u.BukuID = b.BukuID
WHERE u.UlasanID = $id
";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
$data = mysqli_fetch_assoc($res);
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-4">Detail Ulasan Buku</h4>

      <div class="container-fluid mt-3">
        <div class="row mb-2">
          <div class="col-sm-3 fw-bold">Nama User</div>
          <div class="col-sm-9"><?= $data['nama_user'] ?></div>
        </div>

        <div class="row mb-2">
          <div class="col-sm-3 fw-bold">Judul Buku</div>
          <div class="col-sm-9"><?= $data['judul_buku'] ?></div>
        </div>

        <div class="row mb-2">
          <div class="col-sm-3 fw-bold">Ulasan</div>
          <div class="col-sm-9"><?= nl2br($data['Ulasan']) ?></div>
        </div>

         <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control" disabled>
                            <option value="5" <?= ($testimonials->rating == 5) ? 'selected' : '' ?>>★★★★★ (5)</option>
                            <option value="4" <?= ($testimonials->rating == 4) ? 'selected' : '' ?>>★★★★ (4)</option>
                            <option value="3" <?= ($testimonials->rating == 3) ? 'selected' : '' ?>>★★★ (3)</option>
                            <option value="2" <?= ($testimonials->rating == 2) ? 'selected' : '' ?>>★★ (2)</option>
                            <option value="1" <?= ($testimonials->rating == 1) ? 'selected' : '' ?>>★ (1)</option>
                        </select>
                    </div>

        <div class="mt-3">
          <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
