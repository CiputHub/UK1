<?php
include '../../app.php';

if (isset($_POST['tombol'])) {
    $Username    = escapeString($_POST['Username']);
    $Email       = escapeString($_POST['Email']);
    $NamaLengkap = escapeString($_POST['NamaLengkap']);
    $Alamat      = escapeString($_POST['Alamat']);
    $Password    = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $Role        = escapeString($_POST['Role']); // hanya administrator / petugas

    // cek role backend
    if ($Role !== 'administrator' && $Role !== 'petugas') {
        echo "<script>alert('Role tidak valid!'); window.history.back();</script>";
        exit;
    }

    // cek jika role administrator sudah ada
    if ($Role == 'administrator') {
        $cekAdmin = mysqli_query($connect, "SELECT * FROM user WHERE Role='administrator'");
        if (mysqli_num_rows($cekAdmin) > 0) {
            echo "<script>alert('Akun Administrator sudah ada, tidak bisa buat lagi!'); window.history.back();</script>";
            exit;
        }
    }

    // cek email unik
    $cekEmail = mysqli_query($connect, "SELECT * FROM user WHERE Email='$Email'");
    if (mysqli_num_rows($cekEmail) > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
        exit;
    }

    // insert data
    $q = "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Role)
          VALUES ('$Username', '$Password', '$Email', '$NamaLengkap', '$Alamat', '$Role')";

    if (mysqli_query($connect, $q)) {
        echo "<script>alert('Registrasi berhasil, silakan login!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!'); window.history.back();</script>";
    }
}
?>
