<?php
session_name("backendSession");
session_start();
include '../../app.php';
include '../../partials/header.php';
include '../../partials/navbar.php';
$current_dir = 'users';
include '../../partials/sidebar.php';
?>

<div class="container-fluid mt-3">
  <div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">
      <h4 class="mb-3">Tambah User</h4>
      <form action="../../action/users/store.php" method="POST">
        <div class="mb-3">
          <label>Username</label>
          <input type="text" name="Username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="Password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="Email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Nama Lengkap</label>
          <input type="text" name="NamaLengkap" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Alamat</label>
          <textarea name="Alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label>Role</label>
          <select name="Role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="administrator">Administrator</option>
            <option value="petugas">Petugas</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name="tombol">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>

<?php 
include '../../partials/footer.php';
include '../../partials/script.php';
?>
