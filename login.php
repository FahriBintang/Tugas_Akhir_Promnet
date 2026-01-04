<?php
session_start();
require("function.php");

//arahan ke halaman sesuai role, jika sudah login
if( isset($_SESSION["login"]) ) {
    if( $_SESSION["role"] === 'admin' ) {
        header("Location: index.php");
    } else {
        header("Location: indexz.php");
    }
    exit;
}

$error = "";
if(isset($_POST['tombol_login'])){
    
    $result = login($_POST); 
   
    if($result === true){
        //logika arahan berdasarkan role
        if($_SESSION["role"] === 'admin'){
            header("Location: index.php"); 
        } else {
            header("Location: indexz.php");
        }
        exit;
    } else {

        $error = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page - OurMusic</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f7fb;
        }
        .login-card {
            margin-top: 20%; 
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 18px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="class="fw-bold fs-4 text-black style="font-family: 'Poppins';">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-card">
                <h3 class="text-center mb-4">Login</h3>

                <?php if($error) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username..." autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
                    </div>

                    <button type="submit" name="tombol_login" class="btn btn-warning w-100">Login</button>
                    
                    <p class="mt-3 text-center">
                        Belum punya akun? <a href="register.php" class="text-decoration-none">Daftar di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>