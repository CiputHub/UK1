<?php
if(!isset($_GET['id'])){
    echo "
    <script>
        alert('Tidak Bisa Memilih ID ini');
        window.location.href='../../pages/blog/index.php';
        </script>
    ";
}

$id = $_GET['id'];

$qSelect = "SELECT * FROM blogs WHERE id='$id'";
$result = mysqli_query($connect, $qSelect) or die (mysqli_error($connect));

$blogs = $result->fetch_object();
if(!$blogs) {
    die("data tidak ditemukan");
}
