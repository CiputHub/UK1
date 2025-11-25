<?php
session_start();
include '../../app.php'; // ini sudah ada escapeString
// tidak perlu include './show.php';

if (isset($_POST['tombol'])) {
$id = $_POST['UlasanID'];
$UserID = escapeString($_POST['UserID']);
$BukuID = escapeString($_POST['BukuID']);
$Ulasan = escapeString($_POST['Ulasan']);
$rating= escapeString($_POST['rating']);

$q = "UPDATE ulasanbuku SET UserID='$UserID', BukuID='$BukuID', Ulasan='$Ulasan', rating='$rating' WHERE UlasanID=$id";

if (mysqli_query($connect, $q)) {
            echo "
            <script>
                alert('Data Berhasil Diedit');
                window.location.href = '../../pages/ulasan-buku/index.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal Diedit');
                window.location.href = '../../pages/ulasan-buku/edit.php?UlasanID=$id';
            </script>
            ";
        }
    }

?>
