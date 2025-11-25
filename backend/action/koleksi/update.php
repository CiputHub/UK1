<?php
session_start();
include '../../app.php'; // ini sudah ada escapeString
// tidak perlu include './show.php';

if (isset($_POST['tombol'])) {
$id = $_POST['KoleksiID'];
$UserID = escapeString($_POST['UserID']);
$BukuID = escapeString($_POST['BukuID']);

$q = "UPDATE koleksipribadi SET UserID='$UserID', BukuID='$BukuID' WHERE KoleksiID=$id";

if (mysqli_query($connect, $q)) {
            echo "
            <script>
                alert('Data Berhasil Diedit');
                window.location.href = '../../pages/koleksi/index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Diedit');
                window.location.href = '../../pages/koleksi/edit.php?KoleksiID=$id';
            </script>
            ";
        }
    }

?>



