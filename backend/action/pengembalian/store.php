<?php
include '../../app.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peminjaman_id = $_POST['PeminjamanID'];
    $tgl_pengembalian = $_POST['TanggalPengembalian'];
    $kondisi = $_POST['KondisiBuku'];

    // Upload dokumentasi
    $foto = null;
    if (isset($_FILES['Dokumentasi']) && $_FILES['Dokumentasi']['error'] == 0) {
        $targetDir = "../../uploads/pengembalian/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $foto = time() . "_" . basename($_FILES['Dokumentasi']['name']);
        $targetFile = $targetDir . $foto;
        move_uploaded_file($_FILES['Dokumentasi']['tmp_name'], $targetFile);
    }

    $q = "INSERT INTO pengembalian (PeminjamanID, TanggalPengembalian, KondisiBuku, Dokumentasi) 
          VALUES ('$peminjaman_id', '$tgl_pengembalian', '$kondisi', '$foto')";
    mysqli_query($connect, $q) or die(mysqli_error($connect));

    echo "<script>alert('Pengembalian berhasil ditambahkan!');window.location='../../pages/pengembalian/index.php';</script>";
}
?>
