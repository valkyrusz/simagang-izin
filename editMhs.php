<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data Mahasiswa</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
	<!-- script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script -->
	<!-- script src="bootstrap4/js/bootstrap.js"></script -->
</head>
<body>
	<?php
	require "head.html";
	require "fungsi.php";
	// require "head.html";
	$id=$_GET['kode'];
	$sql="select * from mhsdiskominfo where id='$id' ";
	$qry=mysqli_query($koneksi,$sql);
	$row=mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
		<h2 class="mb-3 text-center">EDIT DATA IZIN</h2>	
		<div class="row">
		<div class="col-sm-3 text-center">
			<img class="rounded img-thumbnail"src="foto/<?php echo $row['foto']?>">
			<div>
				[ <a href="gantiFotoMhs.php?id=<?php echo $row['id']?>">Ganti Foto</a> ]
			</div>	
		</div>
		<div class="col-sm-9">
			<form id="editMahasiswaForm"enctype="multipart/form-data" method="post" action="sv_editMhs.php">
				<div class="form-group">
					<label for="nim">NIM:</label>
					<input class="form-control" type="text" name="nim" id="nim" value="<?php echo $row['nim']?>" readonly>
				</div>
				<div class="form-group">
					<label for="nama">Nama:</label>
					<input class="form-control" type="text" name="nama" id="nama" value="<?php echo $row['nama']?>">
				</div>
				<div class="form-group">
				<label for="email">Universitas:</label>
				<input class="form-control" type="text" name="univ" id="univ" value="<?php echo $row['univ']?>">
			</div>
            <div class="form-group">
				<label for="email">Program Studi:</label>
				<input class="form-control" type="text" name="prodi" id="prodi" value="<?php echo $row['prodi']?>">
			</div>
            <div class="form-group">
				<label for="email">Tanggal Izin:</label>
				<input class="form-control" type="date" name="tgl" id="tgl" value="<?php echo $row['tgl']?>">
			</div>
            <div class="form-group">
				<label for="email">Keterangan:</label>
				<input class="form-control" type="text" name="ket" id="ket" value="<?php echo $row['ket']?>">
			</div>		
					<button class="btn btn-primary mt-2" type="submit" id="submit">Simpan</button>
				</div>
				<input type="hidden" name="id" id="id" value="<?php echo $id?>">
			</form>
			<div id="ajaxResponse" class="mt-3"></div>
		</div>
		</div>
	</div>
	
	<script>
        $(document).ready(function() {
            // Pratinjau gambar
            $('#foto').on('change', function(event) {
                var input = event.target;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            // Validasi form
            function validateForm() {
                let isValid = true;

                // Validasi nama
                if ($('#nama').val().trim() === '') {
                    $('#namaError').text('Nama tidak boleh kosong');
                    isValid = false;
                } else {
                    $('#namaError').text('');
                }

                // Validasi email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if ($('#email').val().trim() === '') {
                    $('#emailError').text('Email tidak boleh kosong');
                    isValid = false;
                } else if (!emailRegex.test($('#email').val())) {
                    $('#emailError').text('Format email tidak valid');
                    isValid = false;
                } else {
                    $('#emailError').text('');
                }

                return isValid;
            }

            // Submit form dengan AJAX
            $('#editMahasiswaForm').on('submit', function(event) {
                event.preventDefault();

                if (!validateForm()) return false;

                var formData = new FormData(this);

                $.ajax({
                    url: 'sv_editMhs.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json', // Pastikan respons diterima sebagai JSON
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#ajaxResponse').html('<div class="alert alert-success">' + response.message + '</div>');
                            // Redirect opsional setelah berhasil
                            setTimeout(function() {
                                window.location.href = 'ajaxUpdateMhs.php';
                            }, 2000);
                        } else {
                            $('#ajaxResponse').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function() {
                        $('#ajaxResponse').html('<div class="alert alert-danger">Terjadi kesalahan saat mengirim data.</div>');
                    }
                });
            });

        });
    </script>
</body>
</html>
	
