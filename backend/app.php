<?php
    include '../../../config/connection.php';
    include '../../../config/escapeString.php';

    if (session_status() === PHP_SESSION_NONE) {
    session_name("backendSession");
    session_start();
}
?>