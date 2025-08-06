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
    <title>Tentang Kami - Izin Magang Diskominfo Semarang</title>
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

        
        .content-about-us {
            background-color: #ffffff; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 30px; 
            margin-top: 30px; 
            margin-bottom: 30px; 
            line-height: 1.6;
        }
        .content-about-us h1, .content-about-us h2 {
            color: #1e88e5; 
            margin-bottom: 20px;
        }
        .content-about-us p {
            margin-bottom: 15px;
            text-align: justify;
        }
        .content-about-us ul {
            list-style: disc;
            margin-left: 25px;
            margin-bottom: 15px;
        }
        .content-about-us ul li {
            margin-bottom: 5px;
        }
        .highlight {
            font-weight: bold;
            color: #1e88e5;
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
                <div class="content-about-us">
                    <h1>Tentang Kami</h1>
                    <p>
                        Selamat datang di Sistem Informasi Perizinan Mahasiswa Magang Diskominfo Kota Semarang.
                        Platform ini dirancang khusus untuk memfasilitasi proses perizinan bagi mahasiswa yang sedang
                        melaksanakan program magang di lingkungan Dinas Komunikasi dan Informatika (Diskominfo) Kota Semarang.
                    </p>

                    <h2>Tujuan dan Manfaat</h2>
                    <p>
                        Penciptaan website ini bertujuan untuk menyediakan platform yang efisien dan mudah digunakan
                        bagi mahasiswa magang. Dengan adanya sistem ini, mahasiswa dapat mengajukan perizinan terkait
                        magang, seperti izin tidak masuk karena sakit atau keperluan mendesak lainnya,
                        apabila terdapat halangan atau kendala selama program magang berlangsung.
                    </p>
                    <p>
                        Platform ini memungkinkan proses perizinan dilakukan secara online, sehingga meminimalkan
                        prosedur manual dan birokrasi. Hal ini memastikan bahwa pengajuan izin dapat diajukan
                        dan diproses dengan cepat, memungkinkan mahasiswa untuk fokus pada program magang mereka
                        tanpa terbebani oleh proses administratif yang rumit.
                    </p>

                    <h2>Fitur Utama</h2>
                    <ul>
                        <li><span class="highlight">Pengajuan Izin Online:</span> Mahasiswa dapat mengajukan permohonan izin dengan mudah melalui formulir digital.</li>
                        <li><span class="highlight">Efisiensi dan Kemudahan:</span> Proses perizinan menjadi lebih cepat dan dapat diakses dari mana saja.</li>
                        <li><span class="highlight">Pencatatan Terpusat:</span> Semua data perizinan tercatat secara sistematis dan mudah dikelola oleh pihak terkait.</li>
                    </ul>

                    <p>
                        Kami berharap dengan adanya platform ini, pengalaman magang mahasiswa di Diskominfo Kota Semarang
                        menjadi lebih terstruktur, efisien, dan mendukung kelancaran program magang secara keseluruhan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>