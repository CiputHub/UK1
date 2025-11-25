<?php
session_start(); 
include '../../app.php';


$id = $_GET['KategoriID'];
$q = "DELETE FROM kategoribuku WHERE KategoriID=$id";

    $delete  = mysqli_query($connect, $q) or die(mysqli_error($connect));

    if ($delete) {
        echo "
        <script>
            alert('Data Berhasil dihapus');
            window.location.href = '../../pages/kategori-buku/index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal dihapus');
            window.location.href = '../../pages/kategori-buku/index.php';
        </script>
        ";
    }

?>
