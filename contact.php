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
    <title>Kontak Kami - Izin Magang Diskominfo Semarang</title>
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
            padding-left: 250px;
        }
        .navbar a {
            color: white;
        }
        .container {
            flex: 1;
            padding: 20px;
        }
        .container h1 {
            color: #1e88e5;
        }
        footer {
            background-color: #f1f1f1;
            padding: 10px 0;
            text-align: center;
        }


        .content-contact {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .content-contact h1, .content-contact h2 {
            color: #1e88e5;
            margin-bottom: 20px;
        }
        .content-contact p {
            margin-bottom: 15px;
            text-align: justify;
        }
        .contact-info {
            list-style: none;
            padding: 0;
        }
        .contact-info li {
            margin-bottom: 15px;
        }
        .contact-info li i {
            width: 30px;
            text-align: center;
            color: #1e88e5;
            margin-right: 10px;
        }
        .contact-map {
            margin-top: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .contact-map iframe {
            width: 100%;
            height: 300px;
            border: none;
        }
    </style>
</head>
<body>
    <?php
    require "head.html";
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="content-contact">
                    <h1>Kontak Kami</h1>
                    <p>
                        Jika Anda memiliki pertanyaan lebih lanjut mengenai program magang atau membutuhkan bantuan,
                        jangan ragu untuk menghubungi kami melalui informasi di bawah ini atau kunjungi kantor kami.
                    </p>

                    <h2>Informasi Kontak Diskominfo Kota Semarang</h2>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <strong>Alamat:</strong> Jl. Pemuda No. 175, Sekayu, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50132
                        </li>
                        <li>
                            <i class="fas fa-phone"></i>
                            <strong>Telepon:</strong> (024) 3549247
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <strong>Email:</strong> diskominfo@semarangkota.go.id
                        </li>
                        <li>
                            <i class="fas fa-globe"></i>
                            <strong>Website:</strong> <a href="https://diskominfo.semarangkota.go.id" target="_blank">diskominfo.semarangkota.go.id</a>
                        </li>
                    </ul>

                    <div class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.885669046639!2d110.42065831477461!3d-7.009716994966601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b5e9d9e4a3d%3A0x892e62b144a1e1b1!2sDinas%20Komunikasi%20dan%20Informatika%20Kota%20Semarang!5e0!3m2!1sid!2sid!4v1625076412345!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>