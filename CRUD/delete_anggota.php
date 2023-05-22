<?php
include '../src/koneksi.php';


session_start();

    if (!isset($_SESSION['id_login'])) {
     echo "<script>alert('Anda Perlu Login Terlebih Dahulu');</script>";
     echo "<script>
     window.location.replace('../client/login.php');
     </script>";
    } 
    else{
        
    };

$id_anggota = $_GET['id_anggota'];

$query = "DELETE FROM anggota WHERE Id_Anggota = ?";
$stmt = $db->prepare($query);

$stmt->execute([$id_anggota]);

if ($stmt->rowCount() > 0) {
    echo "<script>
    alert('Anggota berhasil dihapus.');
    window.location='../client/dashboard.php';</script>";
} else {
    echo "<script>
    alert('Anggota gagal dihapus.');
    window.location='../client/dashboard.php';</script>";
}
?>