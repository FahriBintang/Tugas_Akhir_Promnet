<?php 
session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function.php");

    if(isset($_POST['tombol_submit'])){
        //  var_dump($_POST);

        // ==============
        // CARA PERTAMA
        // ==============

        // $nim = $_POST['nim'];
        // $nama = $_POST['nama'];
        // $email = $_POST['email'];
        // $jurusan = $_POST['jurusan'];
        // $gambar = $_POST['gambar'];

        // $query = "INSERT INTO mahasiswa (nim, nama, email, jurusan, gambar)
        //           VALUES ('$nim', '$nama', '$email', '$jurusan', '$gambar')
        //          ";

        // $result = mysqli_query($conn, $query);

        // if($result){
            // echo "
            //     <script>
            //         alert('Data berhasil ditambahkan ke database!');
            //         document.location.href = 'index.php';
            //     </script>
            // ";
        // }else{
        //     echo "
        //         <script>
        //             alert('Data gagal ditambahkan ke database!');
        //             document.location.href = 'index.php';
        //         </script>
        //     ";
        // }


        // ==============
        // CARA KEDUA
        // ==============

        // jika query hapus data yang ada di fungsi hapus_data() di function.php bernilai true (berhasil dihapus)
        // maka tampilkan alert bahwa data berhasil dihapus
        if(tambah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan ke database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="class="fw-bold fs-4 text-black style="font-family: 'Poppins';">

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6d3500ff;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">OurMusic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <li class="nav">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Tambah Data Music</h1>
            <a href="index.php" class="mb-2 text-dark">Kembali</a>
            <div class="col-md-6">
                <form action="" method="POST" enctype="multipart/form-data">
                <!-- <form action="" method="POST"> -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama</label>
                        <input type="text" class="form-control" name="nama" id="id" placeholder="nama" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Genre</label>
                        <input type="text" class="form-control" name="kategori" id="id" placeholder="kategori" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Penyanyi</label>
                        <input type="text" class="form-control" name="penyanyi" id="id" placeholder="penyanyi" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Rilis</label>
                        <input type="text" class="form-control" name="tahun" id="id" placeholder="tahun" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="tombol_submit" class="btn-sm btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>