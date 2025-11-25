<?php
include '../../app.php';

$id = $_GET['UserID'];

$qDelete = "DELETE FROM user WHERE UserID='$id'";
if(mysqli_query($connect, $qDelete)){
    echo "<script>alert('User berhasil dihapus'); window.location.href='../../pages/users/index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus user'); window.location.href='../../pages/users/index.php';</script>";
}
?>
