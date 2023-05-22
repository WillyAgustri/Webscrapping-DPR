<!-- Connect To Database -->
<?php 
include('../src/koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Connect CSS -->
    <link rel="stylesheet" href="./resource/login.css">


</head>
<body>
    <main>
        <div id="container">
            <form action="" method="POST">
                <img
                    src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExOTg0ODJkNTI0MjM0ZjZlNTliNzk1MTNiYTU2MTY5OWNhZmJkZTMzNSZjdD1n/f3iwJFOVOwuy7K6FFw/giphy.gif"><br>
                <input type="text" name="username" value="admin" placeholder="Username"><br>
                <input type="password" name="password" value="admin" placeholder="Password"><br>
                <input type="submit" name="submit" value="Log-In"><br>

            </form>
        </div>
    </main>
</body>
</html>




<?php
session_start();


if (isset($_POST['submit'])) {
// ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// cek apakah data form kosong
if (empty($username) || empty($password)) {
    $_SESSION['error'] = 'Username atau password kosong';
    echo "<script>alert('Username atau password kosong');</script>";
    // echo "<script>window.location.replace('../../login.html');</script>";
    exit();

}

// query untuk mencari user di database
$query = "SELECT * FROM login_user WHERE username = :username AND password = :password";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// jika data pengguna ada
if ($user) {
        $_SESSION['id_login'] = $user['id_login'];
        if (isset($_SESSION['id_login'])) {
            echo "<script>alert('Berhasil Login');</script>";
            header("Location: ./dashboard.php");
        } else {
            // Jika user id belum disimpan di dalam session, redirect atau lakukan operasi lainnya
            echo "<script>alert('Gagal menyimpan user ID ke dalam session.');</script>";
        }

} else {
    echo "<script>
alert('Username atau password Salah!');
</script>";
    echo "<script>
window.location.replace('login.php');
</script>";
}
}
?>