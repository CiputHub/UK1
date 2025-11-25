<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
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
      <h5>Detail Ulasan Buku</h5>
      <table class="table table-bordered table-striped">
        <tr>
          <th style="width: 200px;">Nama User</th>
          <td><?= $data['nama_user'] ?></td>
        </tr>
        <tr>
          <th>Judul Buku</th>
          <td><?= $data['judul_buku'] ?></td>
        </tr>
        <tr>
          <th>Ulasan</th>
          <td><?= $data['Ulasan'] ?></td>
        </tr>
        <tr>
          <th>Rating</th>
          <td><?= $data['Rating'] ?></td>
        </tr>
      </table>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
