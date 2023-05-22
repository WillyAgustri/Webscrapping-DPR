<?php
include '../src/koneksi.php';
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['id_login'])) {
    // Hapus semua data session
    session_unset();
    // Hancurkan session
    session_destroy();
    // Redirect ke halaman login
    header("Location: ../client/login.php");
    exit();
} else {
    // Redirect ke halaman login
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Hari dalam masa lalu
    header("Location: ../client/login.php");
    exit();
}
?>