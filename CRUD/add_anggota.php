<!-- Connect To Database -->
<?php 
include("../src/koneksi.php");


session_start();

    if (!isset($_SESSION['id_login'])) {
     echo "<script>alert('Anda Perlu Login Terlebih Dahulu');</script>";
     echo "<script>
     window.location.replace('../client/login.php');
     </script>";
    } 
    else{
        
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="../client/resource/dashboard.css">
</head>
<body>
    <div name="div1" class="targetdiv col-sm-6 col-lg-4">
        <div class="frost-glass shadow p-4 rounded-3">
            <h2 class="text-lg fw-bold mb-2">Tambah Data Anggota</h2>
            <form action="" method="post">
                <div class="mb-3 text-white">
                    <label for="no_anggota" class="form-label">No Anggota:</label>
                    <input type="text" class="form-control" name="id_anggota">
                </div>
                <div class="mb-3 text-white">
                    <label for="source" class="form-label">Source:</label>
                    <input type="text" class="form-control" name="source">
                </div>
                <div class="mb-3 text-white">
                    <label for="nama_fraksi_dapil" class="form-label">Nama/Fraksi/Dapil:</label>
                    <input type="text" class="form-control" name="nama_fraksi_dapil">
                </div>
                <div class="mb-3 text-white">
                    <label for="akd" class="form-label">AKD:</label>
                    <input type="text" class="form-control" name="akd">
                </div>
                <div class="mb-3 text-white">
                    <label for="jabatan" class="form-label">Jabatan:</label>
                    <input type="text" class="form-control" name="jabatan">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                <a type="button" href="../client/dashboard.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>


<?php


//melakukan pengecekan jika button submit diklik maka akan menjalankan perintah simpan dibawah ini
if (isset($_POST['submit'])) {
    //menampung data dari inputan
    $id_anggota = $_POST['id_anggota'];
    $source = $_POST['source'];
    $akd = $_POST['akd'];
    $nama = $_POST['nama_fraksi_dapil'];
    $jabatan = $_POST['jabatan'];

    //query untuk menambahkan data ke tabel data_anggota
    $stmt = $db->prepare("INSERT INTO anggota (Id_Anggota, Source, `NAMA/FRAKSI/DAPIL`, AKD, Jabatan) VALUES (:id_anggota, :source, :nama, :akd, :jabatan)");
    $stmt->bindParam(':id_anggota', $id_anggota);
    $stmt->bindParam(':source', $source);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':akd', $akd);
    $stmt->bindParam(':jabatan', $jabatan);
    $stmt->execute();

    //ini untuk menampilkan alert berhasil dan redirect ke halaman index
    echo "<script>alert('Data Berhasil Ditambahkan.');window.location='../client/dashboard.php';</script>";
}


?>