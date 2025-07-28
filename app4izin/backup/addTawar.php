<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Akademik::Tambah Data Kuliah Tawar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/stylekuu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php require "head.html"; ?>

    <div class="utama">        
        <br><br><br>        
        <h3>TAMBAH DATA KULIAH TAWAR</h3>
        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        
        <form id="TawarForm" method="post" action="sv_addTawar.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="idmatkul">ID Mata Kuliah:</label>
                <input class="form-control" type="text" name="idmatkul" id="idmatkul" required>
            </div>
            <div class="form-group">
                <label for="npp">NPP Dosen:</label>
                <input class="form-control" type="text" name="npp" id="npp" required>
            </div>
            <div class="form-group">
                <label for="klp">Kelompok:</label>
                <input class="form-control" type="text" name="klp" id="klp" required>
            </div>
            <div class="form-group">
                <label for="hari">Hari:</label>
                <input class="form-control" type="text" name="hari" id="hari" required>
            </div>
            <div class="form-group">
                <label for="jamkul">Jam Kuliah:</label>
                <input class="form-control" type="time" name="jamkul" id="jamkul" required>
            </div>
            <div class="form-group">
                <label for="ruang">Ruang:</label>
                <input class="form-control" type="text" name="ruang" id="ruang" required>
            </div>
            <div>        
                <button type="submit" class="btn btn-primary" value="Simpan">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        // Form submission dengan AJAX
        $("#TawarForm").on("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: 'sv_addTawar.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#success").show().html(response);
                },
                error: function() {
                    alert("Terjadi kesalahan saat mengirim data.");
                }
            });
        });
    </script>
</body>
</html>


