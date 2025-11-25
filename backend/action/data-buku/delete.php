<?php
session_name("backend_session");
session_start(); 
include '../../app.php';

if (isset($_GET['BukuID'])) {
    $id = escapeString($_GET['BukuID']);

    // Ambil data lama
    $qSelect = "SELECT * FROM buku WHERE BukuID='$id'";
    $result  = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));
    $buku    = mysqli_fetch_object($result);

    if (!$buku) {
        echo "
        <script>
            alert('Data tidak ditemukan');
            window.location.href='../../pages/data-buku/index.php';
        </script>";
        exit;
    }

    // hapus file cover juga
    if($buku->cover){
        $filePath = "../../uploads/cover/".$buku->cover;
        if(file_exists($filePath)) unlink($filePath);
    }

    // Hapus data
    $qDelete = "DELETE FROM buku WHERE BukuID='$id'";
    $delete  = mysqli_query($connect, $qDelete) or die(mysqli_error($connect));

    if ($delete) {
        echo "
        <script>
            alert('Data Berhasil dihapus');
            window.location.href = '../../pages/data-buku/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal dihapus');
            window.location.href = '../../pages/data-buku/index.php';
        </script>";
    }
}
?>
