<?php 
session_start();
require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"]; // mengambil id dari tombol Add
$username = $_SESSION["username"];

if (tambah_playlist($id, $username) > 0) {
    echo "<script>
            alert('Berhasil ditambahkan!');
            document.location.href = 'indexz.php';
          </script>";
} else {
    echo "<script>
            document.location.href = 'indexz.php';
          </script>";
}
?>
