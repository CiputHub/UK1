<?php
include '../../app.php';

if(isset($_POST['BukuID']) && isset($_POST['KategoriID'])){
    $BukuID = $_POST['BukuID'];
    $KategoriID = $_POST['KategoriID'];

    $q = "INSERT INTO kategoribuku_relasi (BukuID, KategoriID) VALUES ('$BukuID','$KategoriID')";
    if(mysqli_query($connect, $q)){
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='../../pages/kategori-relasi/index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>
