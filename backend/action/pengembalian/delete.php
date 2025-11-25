<?php
include '../../app.php';

$id = $_GET['id'];
$q = "DELETE FROM pengembalian WHERE PengembalianID='$id'";
mysqli_query($connect, $q) or die(mysqli_error($connect));

echo "<script>alert('Data berhasil dihapus!');window.location='../../pages/pengembalian/index.php';</script>";
?>
