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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Informasi Magang::Tambah USER</title>
	<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
	<!-- Import Materialize CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
	<!-- Import Google Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Custom Style -->
	<style>
		body {
			background-color: #f8f9fa;
		}
		.container {
			margin-top: 50px;
		}
		.card {
			padding: 20px;
			border-radius: 10px;
		}
		h4 {
			margin-bottom: 30px;
			font-weight: 600;
			color: #1e88e5;
		}
		.btn-custom {
			background-color: #1e88e5;
			color: white;
		}
		.btn-custom:hover {
			background-color: #1565c0;
		}
	</style>
</head>
<?php
		require "head.html";
	?>
<body>
	<!-- Navbar -->
	<nav>
		<div class="nav-wrapper blue">
			<a href="#" class="brand-logo center"></a>
			<ul class="right">
				<li><a href="logout.php"><i class="material-icons">exit_to_app</i></a></li>
			</ul>
		</div>
	</nav>

	<!-- Content -->
	<div class="container">
		<div class="row">
			<div class="col s12 m8 offset-m2">
				<div class="card white z-depth-3">
					<h4 class="center-align">Form Tambah User</h4>
					<form method="post" action="sv_addUser.php" enctype="multipart/form-data">
						<div class="input-field">
							<i class="material-icons prefix"></i>
							<input id="username" name="username" type="text" class="validate" required>
							<label for="username">Username</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix"></i>
							<input id="password" name="password" type="password" class="validate" required>
							<label for="password">Password</label>
						</div>
						<div class="input-field">
							<i class="material-icons prefix"></i>
							<select name="status" id="status" required>
								<option value="" disabled selected>Pilih Status</option>
								<?php
								$status = array('Admin', 'Mahasiswa', 'TU', 'Dosen');
								foreach ($status as $s) {
									echo "<option value='$s'>$s</option>";
								}
								?>
							</select>
							<label for="status">Status</label>
						</div>
						<div class="center-align">
							<button type="submit" class="btn btn-custom waves-effect waves-light">
								<i class="material-icons left"></i>Simpan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Materialize JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Initialize Select Dropdown
			var elems = document.querySelectorAll('select');
			var instances = M.FormSelect.init(elems);
		});
	</script>
</body>
</html>
