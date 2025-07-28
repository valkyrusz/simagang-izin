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
	<title>Sistem Informasi Magang::Tambah Perizinan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
	<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
</head>

<body>
	<?php require "head.html"; ?>
	<div class="utama">
		<br><br><br>
		<h3>TAMBAH  PERIZINAN</h3>
		<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
		</div>
		<form id="mahasiswaForm" method="post" action="sv_addMhs.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nim">NIM:</label>
				<input class="form-control" type="text" name="nim" id="nim" required>
			</div>
			<div class="form-group">
				<label for="nama">Nama:</label>
				<input class="form-control" type="text" name="nama" id="nama">
			</div>
			<div class="form-group">
				<label for="email">Universitas:</label>
				<input class="form-control" type="text" name="univ" id="univ">
			</div>
            <div class="form-group">
				<label for="email">Program Studi:</label>
				<input class="form-control" type="text" name="prodi" id="prodi">
			</div>
            <div class="form-group">
				<label for="email">Tanggal Izin:</label>
				<input class="form-control" type="date" name="tgl" id="tgl">
			</div>
            <div class="form-group">
				<label for="email">Keterangan:</label>
				<input class="form-control" type="text" name="ket" id="ket">
			</div>
			<div class="form-group">
				<label for="foto">Foto</label>
				<input class="form-control" type="file" name="foto" id="foto">
			</div>
			<div>
				<button type="submit" class="btn btn-primary mt-2" value="Simpan">Simpan</button>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Form submission with AJAX
    $("#mahasiswaForm").on("submit", function(event) {
        event.preventDefault();

        // Validate NIM
        const nimInput = $('#nim').val();
        const regex = /^[A-Za-z].*$/;

        // Validate character length
        if (nimInput.length > 14) {
            alert("NIM tidak boleh lebih dari 14 karakter.");
            return false;
        } else if (nimInput.length < 14) {
            alert("NIM harus tepat 14 karakter.");
            return false;
        }

        // Validate first character
        if (!regex.test(nimInput)) {
            alert("Karakter pertama NIM harus berupa huruf.");
            return false;
        }

        var formData = new FormData(this);

        $.ajax({
            url: 'sv_addMhs.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#success").show(); // Show success alert
                $("#success").html("Data berhasil disimpan!"); // Optional: Customize success message
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $("#ajaxResponse").html("Terjadi kesalahan saat mengirim data: " + textStatus + " - " + errorThrown);
            }
        });
    });

    // NIM input validation on input and blur
    $('#nim').on('input blur', function() {
        const nimInput = $(this).val();
        const regex = /^[A-Za-z].*$/;

        // Validate character length
        if (nimInput.length > 14) {
            this.setCustomValidity("NIM tidak boleh lebih dari 14 karakter.");
        } else if (nimInput.length < 14) {
            this.setCustomValidity("NIM harus tepat 14 karakter.");
        } else {
            this.setCustomValidity(""); // Reset error message
        }

        // Validate first character
        if (!regex.test(nimInput)) {
            this.setCustomValidity("Karakter pertama NIM harus berupa huruf.");
        }

        // Check if NIM exists in the database
        if (nimInput.length === 14) {
            $.ajax({
                url: 'check_nim.php',
                type: 'POST',
                data: { nim: nimInput },
                success: function(response) {
                    if (response === 'exists') {
                        alert("Data sudah ada, silahkan isikan yang lain");
                        $('#nim').focus();
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat memeriksa NIM.");
                }
            });
        }
    });
});
</script>

</body>
</html>