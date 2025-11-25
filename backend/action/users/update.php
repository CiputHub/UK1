<?php
include '../../app.php';

$id = intval($_POST['UserID']); // pastikan id aman

if(isset($_POST['tombol'])){
    $Username = mysqli_real_escape_string($connect, $_POST['Username']);
    $Email = mysqli_real_escape_string($connect, $_POST['Email']);
    $NamaLengkap = mysqli_real_escape_string($connect, $_POST['NamaLengkap']);
    $Alamat = mysqli_real_escape_string($connect, $_POST['Alamat']);
    $Role = $_POST['Role'];

    // Cek apakah email sudah digunakan oleh user lain
    $check = mysqli_query($connect, "SELECT UserID FROM user WHERE Email='$Email' AND UserID != $id");
    if(mysqli_num_rows($check) > 0){
        echo "<script>
                alert('Email sudah terdaftar, gunakan email lain!');
                window.location.href='../../pages/users/edit.php?UserID=$id';
              </script>";
        exit();
    }

    // Jika password diisi, hash baru, kalau kosong tetap password lama
    $password_sql = "";
    if(!empty($_POST['password'])){
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_sql = ", Password='$password'";
    }

    $q = "UPDATE user 
          SET Username='$Username', Email='$Email', NamaLengkap='$NamaLengkap', Alamat='$Alamat', Role='$Role' 
          $password_sql
          WHERE UserID=$id";

    if(mysqli_query($connect, $q)){
        echo "<script>
                alert('User berhasil diupdate');
                window.location.href='../../pages/users/index.php';
              </script>";
    } else {
        $errorMsg = mysqli_error($connect);
        echo "<script>
                alert('Gagal update user: $errorMsg');
                window.location.href='../../pages/users/edit.php?id=$id';
              </script>";
    }
}
?>
