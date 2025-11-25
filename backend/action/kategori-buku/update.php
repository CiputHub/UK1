<?php
session_start();
include '../../app.php'; // ini sudah ada escapeString
// tidak perlu include './show.php';

if (isset($_POST['tombol'])) {
$id = $_POST['KategoriID'];
$NamaKategori = escapeString($_POST['NamaKategori']);

$q = "UPDATE kategoribuku SET NamaKategori='$NamaKategori' WHERE KategoriID=$id";

if (mysqli_query($connect, $q)) {
            echo "
            <script>
                alert('Data Berhasil Diedit');
                window.location.href = '../../pages/kategori-buku/index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Diedit');
                window.location.href = '../../pages/kategori-buku/edit.php?KategoriID=$id';
            </script>
            ";
        }
    }

?>



