<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$buku_id = intval($_POST['BukuID']);
$ulasan = mysqli_real_escape_string($connect, $_POST['Ulasan']);
$rating = intval($_POST['Rating']);

// Validasi rating
if ($rating < 0 || $rating > 100) {
    header("Location: tambah-ulasan.php?id=$buku_id&error=rating");
    exit;
}

// Insert ulasan
$q = "INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating) 
      VALUES ($user_id, $buku_id, '$ulasan', $rating)";
mysqli_query($connect, $q) or die(mysqli_error($connect));

// Redirect ke halaman detail buku dengan pesan sukses
header("Location: detail-buku.php?id=$buku_id&review_success=1");
exit;
?>
