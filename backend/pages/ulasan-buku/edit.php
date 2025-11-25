<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'ulasan-buku';
include '../../partials/sidebar.php';

// Ambil ID dari URL (pastikan link edit.php?id=... dari index.php)
$id = $_GET['id'];

$q = "SELECT * FROM ulasanbuku WHERE UlasanID=$id";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
$ulasan = mysqli_fetch_assoc($res);


// Ambil data user & buku
$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user");
$qBuku  = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>


<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
         <h4 class="mb-3">Tambah Ulasan</h4>
      <form action="../../action/ulasan/update.php" method="POST">
        <input type="hidden" name="UlasanID" value="<?= $ulasan['UlasanID'] ?>">

        <div class="mb-3">
          <label>User</label>
          <select name="UserID" class="form-control" required>
            <?php while($u = $qUsers->fetch_object()): ?>
              <option value="<?= $u->UserID ?>" <?= $ulasan['UserID']==$u->UserID?'selected':'' ?>>
                <?= $u->NamaLengkap ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Buku</label>
          <select name="BukuID" class="form-control" required>
            <?php while($b = $qBuku->fetch_object()): ?>
              <option value="<?= $b->BukuID ?>" <?= $ulasan['BukuID']==$b->BukuID?'selected':'' ?>>
                <?= $b->Judul ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Ulasan</label>
          <textarea name="Ulasan" class="form-control" required><?= $ulasan['Ulasan'] ?></textarea>
        </div>

        <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="5" <?= ($testimonials->rating == 5) ? 'selected' : '' ?>>★★★★★ (5)</option>
                            <option value="4" <?= ($testimonials->rating == 4) ? 'selected' : '' ?>>★★★★ (4)</option>
                            <option value="3" <?= ($testimonials->rating == 3) ? 'selected' : '' ?>>★★★ (3)</option>
                            <option value="2" <?= ($testimonials->rating == 2) ? 'selected' : '' ?>>★★ (2)</option>
                            <option value="1" <?= ($testimonials->rating == 1) ? 'selected' : '' ?>>★ (1)</option>
                        </select>
                    </div>

        <button type="submit" class="btn btn-primary" name="tombol">Edit</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
