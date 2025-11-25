<?php
include '../../app.php';

if(isset($_POST['tombol'])){
  $NamaKategori = $_POST['NamaKategori'];

  $q = "INSERT INTO kategoribuku (NamaKategori) VALUES ('$NamaKategori')";
  if(mysqli_query($connect, $q)){
    echo "<script>alert('Kategori berhasil ditambahkan'); window.location.href='../../pages/kategori-buku/index.php';</script>";
  } else {
    echo "Error: " . mysqli_error($connect);
  }
}
?>
