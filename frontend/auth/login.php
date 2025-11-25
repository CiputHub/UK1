<?php
// nama session khusus frontend
session_name("frontend_session");
session_start();

include '../../config/connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($connect, "SELECT * FROM user WHERE Email='$email' LIMIT 1");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['Password'])) {
        // simpan data user ke session (konsisten pakai prefix user_)
        $_SESSION['user_id']   = $user['UserID'];
        $_SESSION['user_role'] = $user['Role'];
        $_SESSION['user_nama'] = $user['NamaLengkap'];

        header("Location: ../index.php");
        exit;
    } else {
        $error = "Email atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login - Perpustakaan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center text-primary mb-4">Login</h3>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($_GET['status']) && $_GET['status'] == 'logout'): ?>
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            ✅ Anda berhasil logout.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>

                    <p class="mt-3 text-center">
                        Belum punya akun? <a href="register.php">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
