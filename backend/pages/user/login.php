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
  <title>Login Backend</title>
  <link rel="stylesheet" href="../../template-admin/documentation/assets/css/graindashboard.css">
  <style>
    body {
      min-height: 100vh;
    }
    .avatar-placeholder {
      font-weight: bold;
      font-size: 1.2rem;
      background: #0d6efd;
      color: #fff;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow p-4 border-0 rounded-3">
          <div class="text-center mb-4">
            <img src="../../template-admin/public/img/logo-buku.jpg" alt="Logo" style="height:60px;">
            <h4 class="mt-2">Digital Library Backend</h4>
          </div>

          <form action="../../action/auth/login_proses.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="Email" placeholder="Masukkan email" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="Password" placeholder="Masukkan password" required>
            </div>

            <div class="d-grid mb-2">
              <button class="btn btn-primary" type="submit">Login</button>
            </div>

            <div class="text-center">
              <!-- <small>Belum punya akun? <a href="register.php">Daftar disini</a></small> -->
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
