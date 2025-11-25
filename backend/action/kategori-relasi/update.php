<?php
session_start();
include '../../app.php'; // ini sudah ada escapeString
// tidak perlu include './show.php';

if (isset($_POST['tombol'])) {
$id = $_POST['KategoriBukuID'];
$BukuID = escapeString($_POST['BukuID']);
$KategoriID = escapeString($_POST['KategoriID']);

$q = "UPDATE kategoribuku_relasi SET BukuID='$BukuID', KategoriID='$KategoriID' WHERE KategoriBukuID=$id";

if (mysqli_query($connect, $q)) {
            echo "
            <script>
                alert('Data Berhasil Diedit');
                window.location.href = '../../pages/kategori-relasi/index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Diedit');
                window.location.href = '../../pages/kategori-relasi/edit.php?kategoriBukuID=$id';
            </script>
            ";
        }
    }

?>



