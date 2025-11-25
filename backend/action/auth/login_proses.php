<?php
// nama session khusus backend
session_name("backendSession");
session_start();

include '../../app.php'; // koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = mysqli_real_escape_string($connect, $_POST['Email']);
    $password = $_POST['Password'];

    $qLogin = "SELECT * FROM user WHERE Email='$email' LIMIT 1";
    $result = mysqli_query($connect, $qLogin) or die(mysqli_error($connect));

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['Password'])) {

            // 🚫 Batasi role: peminjam tidak boleh masuk backend
            if ($user['Role'] === 'peminjam') {
                echo "<script>
                        alert('Akses ditolak! Peminjam tidak bisa login ke Admin.');
                        window.location.href='../../pages/user/login.php';
                      </script>";
                exit();
            }

            // ✅ Set session kalau role admin/petugas
            $_SESSION['user_logged_in'] = true;
            $_SESSION['user_id']        = $user['UserID'];
            $_SESSION['username']       = $user['Username'];
            $_SESSION['nama']           = $user['NamaLengkap'];
            $_SESSION['user_role']      = $user['Role'];

            header('Location: ../../pages/dashboard/index.php');
            exit();
        } else {
            echo "<script>alert('Password salah'); window.location.href='../../pages/user/login.php';</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan'); window.location.href='../../pages/user/login.php';</script>";
    }
}
