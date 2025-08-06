<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            background-image: url("data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M8 16c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zm33.414-6l5.95-5.95L45.95.636 40 6.586 34.05.636 32.636 2.05 38.586 8l-5.95 5.95 1.414 1.414L40 9.414l5.95 5.95 1.414-1.414L41.414 8zM40 48c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-2c3.314 0 6-2.686 6-6s-2.686-6-6-6-6 2.686-6 6 2.686 6 6 6zM9.414 40l5.95-5.95-1.414-1.414L8 38.586l-5.95-5.95L.636 34.05 6.586 40l-5.95 5.95 1.414 1.414L8 41.414l5.95 5.95 1.414-1.414L9.414 40z' fill='%231e88e5' fill-opacity='0.55' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 100px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .login-card .card-title {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .btn-login {
            background-color: #1e88e5;
            color: #fff;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #1565c0;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <div class="card login-card bg-white shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="foto/diskominfos.png" alt="Logo Diskominfo" style="width:200px; height:200px; object-fit:contain; margin-bottom:10px;">
                            <h2 class="card-title mb-2" style="color:#1565c0; font-weight:bold;">SISTEM INFORMASI IZIN</h2>
                            <h5 class="mb-2" style="color:#1e88e5;">Mahasiswa Magang Diskominfo</h5>
                            <p class="text-muted mb-0" style="font-size:1rem;">Silahkan login untuk mengakses sistem pengajuan izin magang.</p>
                        </div>
                        <form method="post" action="">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Nama User</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username" autofocus required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="passw" class="form-label">Password</label>
                                <input type="password" name="passw" id="passw" class="form-control" placeholder="Masukkan Password" required>
                            </div>
                            <button class="btn btn-login btn-block w-100 py-2" type="submit" style="font-size:1.1rem;">Login</button>
                        </form>
                        <?php
                        if (isset($_POST['username'])) {
                            require "fungsi.php";
                            $username = $_POST['username'];
                            $passw = md5($_POST['passw']);
                            $sql = "SELECT * FROM user WHERE username='$username' AND password='$passw'";
                            $hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
                            $data = mysqli_fetch_assoc($hasil);
                        if ($data) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['status'] = $data['status'];
                            header("Location: homeadmin.php");
                            exit;
                        }
                            } elseif (isset($_POST['username']) && !mysqli_num_rows($hasil)) {
                                echo "<div class='alert alert-danger text-center mt-3'>
                                        <strong>Login gagal!</strong> Username atau password salah.
                                      </div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
