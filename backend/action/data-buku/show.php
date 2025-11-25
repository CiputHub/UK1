<?php
include '../../app.php'; // pastikan sudah ada koneksi $connect

if (!isset($_GET['id'])) {
    echo "
    <script>
        alert('Tidak Bisa Memilih ID ini');
        window.location.href='../../pages/data-buku/index.php';
    </script>
    ";
    exit();
}

$id = intval($_GET['id']); // amankan id biar integer

$qSelect = "SELECT * FROM buku WHERE BukuID='$id'";
$result  = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));

$item = $result->fetch_object();

if (!$item) {
    die("Data tidak ditemukan");
}
?>
