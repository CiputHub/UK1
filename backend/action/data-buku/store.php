<?php
include '../../app.php'; 

if(isset($_POST['tombol'])){
    $judul        = escapeString($_POST['judul']);
    $penulis      = escapeString($_POST['penulis']);
    $penerbit     = escapeString($_POST['penerbit']);
    $tahun_terbit = escapeString($_POST['tahun_terbit']);
    $deskripsi = escapeString($_POST['deskripsi']);
    $Stok = escapeString($_POST['Stok']);

  
    
    // Upload cover
    $cover = null;
    if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0){
        $targetDir = "../../../uploads/cover/";
        if(!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES['cover']['name']);
        $targetFile = $targetDir . $fileName;

        if(move_uploaded_file($_FILES['cover']['tmp_name'], $targetFile)){
            $cover = $fileName;
        }
    }

    $q = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, cover, deskripsi, Stok) VALUES('$judul','$penulis','$penerbit','$tahun_terbit','$cover', '$deskripsi', '$Stok')";

    if (mysqli_query($connect, $q)) {
        echo "
        <script>
            alert('Data Berhasil Ditambahkan');
            window.location.href = '../../pages/data-buku/index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan');
            window.location.href = '../../pages/data-buku/create.php';
        </script>";
    }
}
?>
