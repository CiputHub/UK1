<?php
include '../../app.php'; 

$id = $_POST['PengembalianID'];
$peminjaman_id = $_POST['PeminjamanID'];
$tgl = $_POST['TanggalPengembalian'];
$kondisi = $_POST['KondisiBuku'];

$foto = null;
if (isset($_FILES['Dokumentasi']) && $_FILES['Dokumentasi']['error'] == 0) {
    $targetDir = "../../uploads/pengembalian/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $foto = time() . "_" . basename($_FILES['Dokumentasi']['name']);
    $targetFile = $targetDir . $foto;
    move_uploaded_file($_FILES['Dokumentasi']['tmp_name'], $targetFile);

    $q = "UPDATE pengembalian SET 
            PeminjamanID='$peminjaman_id',
            TanggalPengembalian='$tgl',
            KondisiBuku='$kondisi',
            Dokumentasi='$foto'
          WHERE PengembalianID='$id'";
} else {
    $q = "UPDATE pengembalian SET 
            PeminjamanID='$peminjaman_id',
            TanggalPengembalian='$tgl',
            KondisiBuku='$kondisi'
          WHERE PengembalianID='$id'";
}

mysqli_query($connect, $q) or die(mysqli_error($connect));
echo "<script>alert('Data berhasil diupdate!');window.location='../../pages/pengembalian/index.php';</script>";
?>
