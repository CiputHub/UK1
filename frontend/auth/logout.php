<?php
session_name("frontend_session");
session_start();
session_unset();
session_destroy();

echo "<script>
    alert('Berhasil logout!');
    window.location.href='../auth/login.php';
</script>";
exit();
