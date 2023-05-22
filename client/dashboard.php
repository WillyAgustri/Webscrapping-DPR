<!-- Connect To Database -->
<?php
include("../src/koneksi.php");


session_start();

    if (!isset($_SESSION['id_login'])) {
     echo "<script>alert('Anda Perlu Login Terlebih Dahulu');</script>";
     echo "<script>
     window.location.replace('login.php');
     </script>";
    } 
    else{
        
    };
?>
<!--  -->



<!-- Tampilan -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="./resource/dashboard.css">
    <!--  -->

</head>
<body>
    <div class="flex flex-col min-h-screen">
        <!-- Header -->
        <header class="frost-glass text-white">
            <nav class="container d-flex flex-wrap align-items-center justify-content-between py-3">
                <a href="#" class="navbar-brand me-0 me-md-2 fs-3">Dashboard</a>
                <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                    <li class="nav-item">
                        <form action="../CRUD/logout.php" method="POST">
                            <a href="../CRUD/logout.php" class="nav-link px-2 text-white">Log-Out</a>
                        </form>

                    </li>

                </ul>
            </nav>
        </header>

        <!-- Main -->
        <!-- Report -->



        <div class="info" style="margin: 100px;">
            <h1 class="text-center mb-5 text-white ">DPR-RI
                <div>
                    <img src="./resource/images/dpr.png" alt="dpr" srcset="">
                </div>
            </h1>

            <?php
        $stmt = $db->prepare("call total_anggota();");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_anggota = $row["total_anggota"];
        $stmt->closeCursor();

        ?>

            <div class="row g-4 ">
                <div class="col-sm-6 col-lg-4">
                    <div class="frost-glass shadow p-4 rounded-3">
                        <h2 class="text-lg fw-bold mb-2">Anggota</h2>
                        <p class="text-gray-700">Total : <?=$total_anggota ?> Orang</p>
                    </div>


                    <?php
                    $stmt = $db->prepare("call total_komisi();");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total_komisi = $row["komisi"];
                    $stmt->closeCursor();

                     ?>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="frost-glass shadow p-4 rounded-3">
                        <h2 class="text-lg fw-bold mb-2">Anggota Komisi I-XI</h2>
                        <p class="text-gray-700">Total: <?= $total_komisi  ?> Orang</p>
                    </div>
                </div>

                <?php
                $stmt = $db->prepare("call wakil();");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_wakil = $row["wakil_ketua"];
                $stmt->closeCursor();

                ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="frost-glass shadow p-4 rounded-3">
                        <h2 class="text-lg fw-bold mb-2">Wakil Ketua AKD</h2>
                        <p class="text-gray-700">Total: <?= $total_wakil ?> Orang</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">

                </div>
            </div>


            <!--  -->
            <!--  -->
            <!--  -->
            <!--  -->
            <!-- Table -->
            <!--  -->
            <!--  -->
            <!--  -->
            <div class="frost-glass  ">
                <div class="frost-glass card">
                    <table class="frost-glass table table-hover text-white">
                        <thead>
                            <tr>

                                <th scope="col">ID Anggota</th>
                                <th scope="col">Source</th>
                                <th scope="col">Nama/Fraksi/Dapil</th>
                                <th scope="col">AKD</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
       
            $halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
            $halaman_awal = ($halaman > 1) ? ($halaman * 5) - 5 : 0;

            $sebelum = $halaman - 1;
            $setelah = $halaman + 1;

            // Query jumlah data menggunakan PDO
            $jumlah_data = $db->query("SELECT COUNT(Id_Anggota) AS jumlah_data FROM anggota")->fetch(PDO::FETCH_ASSOC)['jumlah_data'];

            $total_halaman = ceil($jumlah_data / 5);
            $query = "SELECT * FROM anggota LIMIT :halaman_awal, 10";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':halaman_awal', $halaman_awal, PDO::PARAM_INT);
            $stmt->execute();
            $nomor = $halaman_awal + 1;
            $jumlah_nomor_halaman = 20;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_anggota = $row['Id_Anggota'];
                $source = $row['Source'];
                $nama = $row['NAMA/FRAKSI/DAPIL'];
                $AKD = $row['AKD'];
                $Jabatan = $row['Jabatan'];
        
                ?>

                            <tr>

                                <th scope="row">
                                    <?php
                        echo $id_anggota
                            ?>
                                </th>

                                <td>
                                    <?php
                       echo '<img src="' . $source . '" alt="Anggota" srcset="" width="50">';
                            ?>


                                </td>
                                <td>
                                    <?php
                        echo $nama
                            ?>
                                </td>
                                <td>
                                    <?php
                        echo $AKD
                            ?>
                                </td>

                                <td>
                                    <?php
                        echo $Jabatan
                            ?>
                                </td>
                                <td>
                                    <a href="../CRUD/edit_anggota.php?id_anggota=<?= $id_anggota; ?>"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-trash-alt"></i> Edit
                                    </a>


                                    <a href="../CRUD/delete_anggota.php?id_anggota=<?= $id_anggota; ?>"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </td>



                            </tr>



                            <?php
            }
            ?>
                            <tr>
                                <thread>

                                    <th scope="col">

                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col">

                                    </th>
                                    <th scope="col"></th>
                                    <th scope="col">

                                    <th scope="col">




                                    </th>


                                    </th>

                                </thread>
                            </tr>



                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halaman - 1 ?>"
                                    <?= ($halaman == 1) ? 'disabled' : '' ?>>Previous</a>
                            </li>
                            <?php
   echo '<li class="page-item "><a class="page-link" href="?halaman=1">..1</a></li>';
                            // batas awal dan akhir nomor halaman yang ditampilkan
                            $batas_awal = max(1, $halaman - floor($jumlah_nomor_halaman / 2));
                            $batas_akhir = min($total_halaman, $halaman + floor($jumlah_nomor_halaman / 2));

                            // tampilkan nomor halaman
                            for ($i = $batas_awal; $i <= $batas_akhir; $i++): ?>
                            <li class="page-item <?= ($i == $halaman) ? 'active' : '' ?>">
                                <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                            </li>
                            <?php endfor ?>

                            <?php

        // tampilkan tanda elipsis jika masih ada nomor halaman yang tidak ditampilkan
    
        if ($halaman + floor($jumlah_nomor_halaman / 2) < $total_halaman) {
            echo '<li class="page-item "><a class="page-link" href="?halaman=137">..137</a></li>';
           
          
                            }

                            ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halaman + 1 ?>"
                                    <?= ($halaman == $total_halaman) ? 'disabled' : '' ?>>Next</a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>




            <!-- Tambah Anggota -->








        </div>
        <di class="corner-add fa-plus">
            <a href="../CRUD/add_anggota.php" class="btn  text-white">Tambah
                Data</a>
        </di>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>

        <script src="./resource/dashboard.js"></script>
</body>
</html>