<?php
   if (!function_exists('escapeString')) {
    function escapeString($str) {
        global $connect;
        return mysqli_real_escape_string($connect, $str);
    }
}

?>