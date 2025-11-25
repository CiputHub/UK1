<?php
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
include '../../partials/sidebar.php';

// Ambil ID dari URL (pastikan link edit.php?id=... dari index.php)
$id = $_GET['id'];

$q = "SELECT * FROM koleksipribadi WHERE KoleksiID=$id";
$res = mysqli_query($connect, $q) or die(mysqli_error($connect));
$koleksi = mysqli_fetch_assoc($res);


// Ambil data user & buku
$qUsers = mysqli_query($connect, "SELECT UserID, NamaLengkap FROM user WHERE Role = 'peminjam'");
$qBuku  = mysqli_query($connect, "SELECT BukuID, Judul FROM buku");
?>


<div class="container-fluid mt-3">
  <div class="card">
    <div class="card-header">Edit koleksi</div>
    <div class="card-body">
      <form action="../../action/koleksi/update.php" method="POST">
        <input type="hidden" name="KoleksiID" value="<?= $koleksi['KoleksiID'] ?>">

        <div class="mb-3">
          <label>User</label>
          <select name="UserID" class="form-control" required>
            <?php while($u = $qUsers->fetch_object()): ?>
              <option value="<?= $u->UserID ?>" <?= $koleksi['UserID']==$u->UserID?'selected':'' ?>>
                <?= $u->NamaLengkap ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Buku</label>
          <select name="BukuID" class="form-control" required>
            <?php while($b = $qBuku->fetch_object()): ?>
              <option value="<?= $b->BukuID ?>" <?= $koleksi['BukuID']==$b->BukuID?'selected':'' ?>>
                <?= $b->Judul ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name="tombol">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
