<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Informasi Akademik::Daftar Mahasiswa</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
		<script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
		<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
		<!-- Use fontawesome 5-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
	</head>
	<style>
	body{background: Darkseagreen}
	.contact-info {
            text-align: center;
			color: black;
			position: fixed;
			font-size:10px;
			padding-left:600px;
			
        }
        .contact-info h1 {
            font-size: 3em;
            margin: 0;
            padding: 0.2em 0;
			
        }
        .contact-info h2 {
            font-size: 2em;
            margin: 0;
            padding: 0.2em 0;
        }
	</style>
	<body>
		<?php
			//memanggil file berisi fungsi2 yang sering dipakai
			require "fungsi.php";
			require "head.html";

			/*	---- cetak data per halaman ---------	*/

			//--------- konfigurasi
			//jumlah data per halaman
			$jmlDataPerHal = 5;

			//pencarian data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from dosen where npp like'%$cari%' or
									namadosen like '%$cari%' or
									homebase like '%$cari%'";
			}else{
				$sql="select * from dosen";		
			}

			$qry = mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
			$jmlData = mysqli_num_rows($qry);

			// CEIL() digunakan untuk mengembalikan nilai integer terkecil yang lebih besar dari 
			//atau sama dengan angka.
			$jmlHal = ceil($jmlData / $jmlDataPerHal);

			if (isset($_GET['hal'])){
				$halAktif=$_GET['hal'];
			}else{
				$halAktif=1;
			}

			$awalData=($jmlDataPerHal * $halAktif)-$jmlDataPerHal;

			//Jika tabel data kosong
			$kosong=false;
			if (!$jmlData){
				$kosong=true;
			}

			//Klausa LIMIT digunakan untuk membatasi jumlah baris yang dikembalikan oleh pernyataan SELECT
			//data berdasar pencarian atau tidak
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from dosen where npp like'%$cari%' or
									namadosen like '%$cari%' or
									homebase like '%$cari%'
									limit $awalData,$jmlDataPerHal";
			}else{
				$sql="select * from dosen limit $awalData,$jmlDataPerHal";		
			}

			//Ambil data untuk ditampilkan
			$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

		?>
		<div class="utama">
			<h2 class="text-center">Daftar Dosen</h2>
			<div class="text-center"><a href="printDsn.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addDosen.php">Tambah Data</a>
			</span>
			<span class="float-right">
				<form action="" method="post" class="form-inline">
					<button class="btn btn-success" type="submit" name="cari" id="tombol-cari"> Cari</button>
					<input class="form-control mr-2 ml-2" type="text" name="cari" placeholder="cari data dosen..." autofocus autocomplete="off" id="keyword">
				</form>
			</span>
			<br><br>

			<ul class="pagination">
				<?php
					//navigasi pagination
					//cetak navigasi back
					if ($halAktif>1){
						$back=$halAktif-1;
						//$back=$halAktif;
						echo "<li class='page-item'><a class='page-link' href=?hal=$back>&laquo;</a></li>";
					}
					//cetak angka halaman
					for($i=1;$i<=$jmlHal;$i++){
						if ($i==$halAktif){
							echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:red;'>$i</a></li>";
						}else{
							
							echo "<li class='page-item'><a class='page-link' href=?hal=$i>$i</a></li>";
						}	
					}
					//cetak navigasi forward
					if ($halAktif<$jmlHal){
						$forward=$halAktif+1;
						echo "<li class='page-item'><a class='page-link' href=?hal=$forward>&raquo;</a></li>";
					}
				?>
			</ul>	

		<div id="container">		
			<!-- Cetak data dengan tampilan tabel -->
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>NPP</th>
						<th>Nama</th>
						<th>Homebase</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						//jika data tidak ada
						if ($kosong){
					?>
						<tr><th colspan="6">
							<div class="alert alert-info alert-dismissible fade show text-center">
							<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
							Data tidak ada
							</div>
						</th></tr>
					<?php
					}else{	
						// $awalData==0, data kalau tampail di page pertama, maka 
						if($awalData==0){
							$no=$awalData+1;
						}else{
							//$no=$awalData;
							$no=$awalData+1;
						}
						while($row=mysqli_fetch_assoc($hasil)){
					?>	
						<tr>
							<td><?php echo $no?></td>
							<td><?php echo $row["npp"]?></td>
							<td><?php echo $row["namadosen"]?></td>
							<td><?php echo $row["homebase"]?></td>
							<td>
								<a class="btn btn-outline-primary btn-sm" href="editDsn.php?kode=<?php echo $row['npp']?>">Edit</a>
								<a class="btn btn-outline-danger btn-sm" href="hpsDsn.php?kode=<?php echo $row["npp"]?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
							</td>
						</tr>
								<?php 
									$no++;
						}
					}
							?>
				</tbody>
			</table>
			<div class="contact-info">
		<h1>A12.2022.06885</h1>
		<b><h2>Kevin Kaylla Vanesha</h2></b>
		<H3>A12.6506</H3>
		</div>
		</div>	
		
	</div>
	<script src="js/scriptD.js"> </script>

</body>
</html>	
