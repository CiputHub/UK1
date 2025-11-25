<?php
// Mulai session backend (beri nama khusus supaya tidak bentrok dengan frontend)
session_name("backendSession");
session_start();

// Hapus semua session
$_SESSION = [];

// Hancurkan session
session_destroy();

// Hapus cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}


echo "<script>
    alert('Berhasil logout!');
    window.location.href='../../pages/user/login.php';
</script>";
exit();
