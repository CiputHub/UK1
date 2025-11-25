<?php
include '../../app.php'; 

if(isset($_POST['tombol'])){
    $UserID = escapeString($_POST['UserID']);
    $BukuID = escapeString($_POST['BukuID']);
    $Ulasan = escapeString($_POST['Ulasan']);
     $rating  = intval($_POST['rating']); // ⭐ tambahin rating

   

    $q = "INSERT INTO ulasan (UserID, BukuID, Ulasan, rating) 
          VALUES ('$UserID', '$BukuID', '$Ulasan', '$rating')";

    if(mysqli_query($connect, $q)){
        echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            window.location.href = '../../pages/ulasan-buku/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
            window.location.href = '../../pages/ulasan-buku/create.php';
        </script>";
    }
}
?>
