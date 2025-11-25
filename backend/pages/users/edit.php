<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'users';
include '../../partials/sidebar.php';
$id = isset($_GET['UserID']) ? intval($_GET['UserID']) : 0;
if($id <= 0){
    echo "<script>alert('ID user tidak valid'); window.location.href='index.php';</script>";
    exit();
}

$q = "SELECT * FROM user WHERE UserID = $id";
$res = mysqli_query($connect, $q);
if(mysqli_num_rows($res) == 0){
    echo "<script>alert('User tidak ditemukan'); window.location.href='index.php';</script>";
    exit();
}

$item = mysqli_fetch_object($res);
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
         <h4 class="mb-3">Tambah Ulasan</h4>
      <form action="../../action/users/update.php" method="POST">
        <input type="hidden" name="UserID" value="<?= $item->UserID ?>">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="Username" class="form-control" value="<?= htmlspecialchars($item->Username) ?>" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="Email" class="form-control" value="<?= htmlspecialchars($item->Email) ?>" required>
        </div>
        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="NamaLengkap" class="form-control" value="<?= htmlspecialchars($item->NamaLengkap) ?>" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="Alamat" class="form-control"><?= htmlspecialchars($item->Alamat) ?></textarea>
        </div>
        <div class="mb-3">
          <label>Role</label>
          <select name="Role" class="form-control" required>
            <option value="administrator" <?= $item->Role=='administrator'?'selected':'' ?>>Administrator</option>
            <option value="petugas" <?= $item->Role=='petugas'?'selected':'' ?>>Petugas</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name="tombol">Edit</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
