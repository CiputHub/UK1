<?php
session_name("frontend_session");
session_start();
include '../config/connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Harus login dulu']);
    exit;
}

$userID = $_SESSION['user_id'];
$bukuID = intval($_POST['buku_id'] ?? 0);

if ($bukuID <= 0) {
    echo json_encode(['success' => false, 'message' => 'Buku tidak valid']);
    exit;
}

// cek apakah sudah ada di koleksi
$qCheck = "SELECT * FROM koleksipribadi WHERE UserID=$userID AND BukuID=$bukuID";
$resCheck = mysqli_query($connect, $qCheck);

if (mysqli_num_rows($resCheck) > 0) {
    // kalau ada → hapus
    $qDel = "DELETE FROM koleksipribadi WHERE UserID=$userID AND BukuID=$bukuID";
    mysqli_query($connect, $qDel);
    echo json_encode(['success' => true, 'inKoleksi' => false]);
} else {
    // kalau belum ada → simpan
    $qIns = "INSERT INTO koleksipribadi (UserID, BukuID) VALUES ($userID, $bukuID)";
    mysqli_query($connect, $qIns);
    echo json_encode(['success' => true, 'inKoleksi' => true]);
}
