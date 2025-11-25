<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$buku_id = intval($_GET['id']);

$q = "DELETE FROM koleksipribadi WHERE UserID=$user_id AND BukuID=$buku_id";
mysqli_query($connect, $q);

header("Location: koleksi.php");
exit;
?>
