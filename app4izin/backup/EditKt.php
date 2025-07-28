<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Akademik::Edit Data Kuliah Tawar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
</head>
<body>
	<?php
	require "fungsi.php";
	require "head.html";
	$idkultawar = $_GET['kode'];
	$sql = "SELECT * FROM kultawar WHERE idkultawar='$idkultawar'";
	$qry = mysqli_query($koneksi, $sql);
	$row = mysqli_fetch_assoc($qry);
	?>
	<div class="utama">
		<h2 class="mb-3 text-center">EDIT DATA KULIAH TAWAR</h2>	
		<div class="row">
			<div class="col-sm-3 text-center">
			</div>
			<div class="col-sm-9">
				<form id="editTawarForm" enctype="multipart/form-data" method="post" action="sv_editTawar.php">
					<div class="form-group">
						<label for="idmatkul">ID Matkul:</label>
						<input class="form-control" type="text" name="idmatkul" id="idmatkul" value="<?php echo $row['idmatkul']; ?>">
					</div>
					<div class="form-group">
						<label for="npp">NPP:</label>
						<input class="form-control" type="text" name="npp" id="npp" value="<?php echo $row['npp']; ?>">
					</div>
					<div class="form-group">
						<label for="klp">Kelompok:</label>
						<input class="form-control" type="text" name="klp" id="klp" value="<?php echo $row['klp']; ?>">
					</div>
					<div class="form-group">
						<label for="hari">Hari:</label>
						<input class="form-control" type="text" name="hari" id="hari" value="<?php echo $row['hari']; ?>">
					</div>
					<div class="form-group">
						<label for="jamkul">Jam Kuliah:</label>
						<input class="form-control" type="text" name="jamkul" id="jamkul" value="<?php echo $row['jamkul']; ?>">
					</div>
					<div class="form-group">
						<label for="ruang">Ruang:</label>
						<input class="form-control" type="text" name="ruang" id="ruang" value="<?php echo $row['ruang']; ?>">
					</div>
					<div>		
						<button class="btn btn-primary" type="submit" id="submit">Simpan</button>
					</div>
					<input type="hidden" name="idkultawar" id="idkultawar" value="<?php echo $idkultawar; ?>">
				</form>
			</div>
		</div>
	</div>
	<script>
	// Submit form dengan AJAX
	$('#editTawarForm').on('submit', function(event) {
		event.preventDefault();

		var formData = new FormData(this);

		$.ajax({
			url: 'sv_editTawar.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response) {
				alert('Data berhasil diperbarui!');
				window.location.href = 'updateTawar.php';
			},
			error: function() {
				alert('Terjadi kesalahan saat menyimpan data.');
			}
		});
	});
	</script>
</body>
</html>
