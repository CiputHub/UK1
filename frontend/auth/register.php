<?php
include '../../config/connection.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];

    // Cek email sudah dipakai atau belum
    $cek = mysqli_query($connect, "SELECT * FROM user WHERE Email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah digunakan!";
    } else {
        $query = "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Role) 
                  VALUES ('$username', '$password', '$email', '$nama', '$alamat', 'peminjam')";
        if (mysqli_query($connect, $query)) {
            echo "<script>alert('Registrasi berhasil, silakan login!'); window.location='login.php';</script>";
        } else {
            $error = "Terjadi kesalahan: " . mysqli_error($connect);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - Perpustakaan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center text-success mb-4">Register</h3>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="register" class="btn btn-success w-100">Register</button>
                    </form>

                    <p class="mt-3 text-center">
                        Sudah punya akun? <a href="login.php">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
