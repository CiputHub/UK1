<?php
session_name("backend_session");
session_start();
include '../../app.php';

if (isset($_POST['tombol'])) {
    $id           = escapeString($_POST['BukuID']); // hidden input
    $Judul        = escapeString($_POST['Judul']);
    $Penulis      = escapeString($_POST['Penulis']);
    $Penerbit     = escapeString($_POST['Penerbit']);
    $tahun_terbit = escapeString($_POST['tahun_terbit']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $Stok = escapeString($_POST['Stok']);

    // Ambil data lama
    $qSelect = "SELECT * FROM buku WHERE BukuID='$id'";
    $resOld  = mysqli_query($connect, $qSelect) or die(mysqli_error($connect));
    $oldData = mysqli_fetch_object($resOld);

    // Upload cover baru (kalau ada)
    $cover = $oldData->cover;
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0){
       $targetDir = "../../../uploads/cover/";

        if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['cover']['name']);
        $targetFile = $targetDir . $fileName;

        if(move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)){
            // hapus cover lama kalau ada
            if($cover && file_exists($targetDir.$cover)){
                unlink($targetDir.$cover);
            }
            $cover = $fileName;
        }
    }

    
    $qUpdate = "UPDATE buku 
            SET Judul='$Judul', 
                Penulis='$Penulis', 
                Penerbit='$Penerbit', 
                tahun_terbit='$tahun_terbit',
                cover='$cover',
                deskripsi='$deskripsi',
                Stok='$Stok'
            WHERE BukuID='$id'";


    $result = mysqli_query($connect, $qUpdate) or die(mysqli_error($connect));

    if ($result) {
        echo "
        <script>
            alert('Data Berhasil Diedit');
            window.location.href = '../../pages/data-buku/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal Diedit');
            window.location.href = '../../pages/data-buku/edit.php?BukuID=$id';
        </script>";
    }
}
?>
