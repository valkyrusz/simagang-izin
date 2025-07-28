<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Home Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylekuu.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom right, #e3f2fd, #ffffff);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar a {
            color: white;
        }
        .container {
            flex: 1;
            padding: 20px;
        }
        .container h1 {
            color: #007bff;
        }
        footer {
            background-color: #f1f1f1;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    require "fungsi.php";
    require "head.html";

    if (!isset($_SESSION['username'])) {
        header("location:index.php");
        exit();
    }
    ?>
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-5 fw-bold text-primary mb-4">Selamat Datang!</h1>
                <p class="lead mb-5">
                    Anda telah berhasil login sebagai <span class="fw-bold text-uppercase text-success"><?php echo $_SESSION['username']; ?></span>.
                    Kelola sistem Anda melalui dashboard ini dengan mudah dan cepat.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Sistem Administrator. All Rights Reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
