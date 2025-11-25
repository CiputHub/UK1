<?php
session_start(); 
include '../../app.php';


$id = $_GET['KategoriBukuID'];
$q = "DELETE FROM kategoribuku_relasi WHERE KategoriBukuID=$id";

    $delete  = mysqli_query($connect, $q) or die(mysqli_error($connect));

    if ($delete) {
        echo "
        <script>
            alert('Data Berhasil dihapus');
            window.location.href = '../../pages/kategori-relasi/index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal dihapus');
            window.location.href = '../../pages/kategori-relasi/index.php';
        </script>
        ";
    }

?>
