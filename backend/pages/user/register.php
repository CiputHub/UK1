<?php
session_name("backendSession");
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    echo "<script>
        alert('Anda sudah login!');
        window.location.href='../dashboard/index.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Backend</title>
  <link rel="stylesheet" href="../../template-admin/documentation/assets/css/graindashboard.css">
</head>
<body class="bg-light d-flex justify-content-center align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow p-4 border-0 rounded-3">
          <div class="text-center mb-4">
            <img src="../../template-admin/public/img/logo-buku.jpg" alt="Logo" style="height:60px;">
            <h4 class="mt-2">Daftar Akun Backend</h4>
          </div>

          <form action="../../action/auth/register_proses.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="NamaLengkap" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="Username" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="Email" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="Password" placeholder="Masukkan password" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Role</label>
              <select class="form-select" name="Role" required>
                <option value="" selected disabled>Pilih role</option>
                <option value="administrator">Administrator</option>
                <option value="petugas">Petugas</option>
              </select>
              <small class="text-muted">Peminjam hanya bisa login di frontend</small>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success">Daftar</button>
            </div>

            <div class="text-center mt-2">
              <small>Sudah punya akun? <a href="login.php">Login disini</a></small>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
