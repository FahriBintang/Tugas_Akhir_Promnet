<?php
session_start();
require "function.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

//ambil data dari username yang login
$user = get_user_by_id($_SESSION['username']);

//logika update login
if (isset($_POST['update'])) {
    // 0 agar jika user tidak mengubah data tetap dianggap berhasil/tidak error
    if (update_profile($_POST) >= 0) {
        // update session agar nama di navbar langsung berubah
        $_SESSION['username'] = $_POST['username'];

        echo "<script>
                alert('Profile berhasil diupdate!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>alert('Profile gagal diupdate');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - OurMusic</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #6d3500ff; 
        }
        .card {
            border-radius: 15px;
            border: none;
        }
        /* .btn-update {
            background-color: #6d3500ff;
            color: white;
            transition: 0.3s;
        } */
        /* .btn-update:hover {
            background-color: #5a2c00;
            color: white;
        } */
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white fw-bold">OurMusic</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow p-4">
                    <h2 class="fw-bold mb-4 text-center">Edit My Profile</h2>
                    
                    <form action="" method="POST">
                        <input type="hidden" name="username_lama" value="<?= $user['username']; ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required autocomplete="off">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="<?= $user['email']; ?>" required autocomplete="off">
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-warning fw-bold">Submit</button>
                            <a href="index.php" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>