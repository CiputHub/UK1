<?php
include '../../app.php';

if(isset($_POST['tombol'])) {
    $Username = mysqli_real_escape_string($connect, $_POST['Username']);
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // hash password
    $Email = mysqli_real_escape_string($connect, $_POST['Email']);
    $NamaLengkap = mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
    $Alamat = mysqli_real_escape_string($connect, $_POST['Alamat']);
    $Role = $_POST['Role'];

    // Kalau role = administrator, cek dulu sudah ada atau belum
    if ($Role === 'administrator') {
        $cek = mysqli_query($connect, "SELECT COUNT(*) as total FROM user WHERE Role='administrator'");
        $data = mysqli_fetch_assoc($cek);

        if ($data['total'] > 0) {
            echo "<script>
                alert('Akun Administrator sudah ada, tidak bisa menambah lagi!');
                window.location.href='../../pages/users/index.php';
            </script>";
            exit;
        }
    }

    // Cek apakah email sudah ada
    $check = mysqli_query($connect, "SELECT UserID FROM user WHERE Email = '$Email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>
            alert('Email sudah terdaftar, gunakan email lain!');
            window.location.href='../../pages/users/create.php';
        </script>";
        exit();
    }

    // Insert data user
    $q = "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat, Role) 
          VALUES ('$Username', '$Password', '$Email', '$NamaLengkap', '$Alamat', '$Role')";

    if (mysqli_query($connect, $q)) {
        echo "<script>
                alert('Data Berhasil Ditambahkan');
                window.location.href = '../../pages/users/index.php';
              </script>";
    } else {
        // Jika terjadi error UNIQUE (misal race condition)
        $errorMsg = mysqli_error($connect);
        if (strpos($errorMsg, 'Duplicate') !== false) {
            echo "<script>
                    alert('Email sudah terdaftar, gunakan email lain!');
                    window.location.href='../../pages/users/create.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data Gagal Ditambahkan: $errorMsg');
                    window.location.href='../../pages/users/create.php';
                  </script>";
        }
    }
}
?>
