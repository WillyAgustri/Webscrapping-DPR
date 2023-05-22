<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dpri";

try {
    // membuat koneksi PDO
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);

    // set mode error PDO ke exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // menampilkan error
    die("terjadi Masalah : " . $e->getMessage());
}
?>