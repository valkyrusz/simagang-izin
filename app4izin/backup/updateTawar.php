<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Informasi Akademik::Daftar Kuliah Tawar</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/stylekuu.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		
		<!-- script src="bootstrap4/jquery/3.3.1/jquery-3.3.1.js"></script -->
		<!-- script src="bootstrap4/js/bootstrap.js"></script -->
		<!-- Use fontawesome 5-->
		
		
	</head>
	<body>
		<?php
			//memanggil file berisi fungsi2 yang sering dipakai
			require "fungsi.php";
			require "head.html";

			/*	---- cetak data per halaman ---------	*/

			//--------- konfigurasi
			//jumlah data per halaman
			$jmlDataPerHal = 7;

			//Cari data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from kultawar where idkultawar like'%$cari%' or
									idmatkul like '%$cari%' or
									npp like '%$cari%' or
									klp like '%$cari%' or
									hari like '%$cari%' or
									ruang like '%$cari%' or
									jamkul like '%$cari%'";
			}else{
				$sql="select * from kultawar";		
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
			//data berdasar Cari atau tidak
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from matkul where kultawar like'%$cari%' or
									idmatkul like '%$cari%' or
									npp like '%$cari%'
									klp like '%$cari%'
									hari like '%$cari%'
									ruang like '%$cari%'
									jamkul like '%$cari%'
									limit $awalData,$jmlDataPerHal";
			}else{
				$sql="select * from kultawar limit $awalData,$jmlDataPerHal";		
			}

			//Ambil data untuk ditampilkan
			$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

		?>
		<div class="utama">
			<h2 class="text-center">Daftar Kuliah Tawar</h2>
			<div class="text-center"><a href="printKultawar.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addTawar.php"style="background-color:darkslategray">Tambah Data</a>
								
			</span>
			
			<!-- Cari dapat mengcopy dari bootstrap ambil dari navbar di modifikasi -->
			<form class="d-flex" action="" method="POST" style="float:right;">
        		<button class="btn btn-outline-success" style="background-color:AntiqueWhite" type="submit"id="tombol-cari">Cari</button>
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari"style="background-color:AntiqueWhite id="keyword"">
        		
      </form>
			

			<br><br>

			<ul class="pagination">
				<?php
					//navigasi pagination
					//cetak navigasi back
					if ($halAktif>1){
						$back=$halAktif-1;
						//$back=$halAktif;
						echo "<li class='page-item'><a class='page-link'style='background:AntiqueWhite;' href=?hal=$back>&laquo;</a></li>";
					}
					//cetak angka halaman
					for($i=1;$i<=$jmlHal;$i++){
						if ($i==$halAktif){
							echo "<li class='page-item'><a class='page-link' href=?hal=$i style='font-weight:bold;color:darkslategray;background:AntiqueWhite;'>$i</a></li>";
						}else{
							
							echo "<li class='page-item'><a class='page-link' style='background:AntiqueWhite;' href=?hal=$i>$i</a></li>";
						}	
					}
					//cetak navigasi forward
					if ($halAktif<$jmlHal){
						$forward=$halAktif+1;
						echo "<li class='page-item'><a class='page-link'  style='background:AntiqueWhite;'href=?hal=$forward>&raquo;</a></li>";
					}
				?>
			</ul>	

			<!-- Cetak data dengan tampilan tabel -->
			<div id="container">
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>ID</th>
						<th>NPP</th>
						<th>Kelompok</th>
						<th>Hari</th>
						<th>Jam</th>
						<th>Ruang</th>
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
							
							<td><?php echo $row["idmatkul"]?></td>
							<td><?php echo $row["npp"]?></td>
							<td><?php echo $row["klp"]?></td>
							<td><?php echo $row["hari"]?></td>
							<td><?php echo $row["jamkul"]?></td>
							<td><?php echo $row["ruang"]?></td>
							<td>
								<a class="btn btn-outline-primary btn-sm" href="editKt.php?kode=<?php echo $row['idkultawar']?>"  id="koreksi">Edit</a>
								<a class="btn btn-outline-danger btn-sm" href="hpsKt.php?kode=<?php echo $row["idkultawar"]?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
							</td>
						</tr>
								<?php 
									$no++;
						}
					}
							?>
				</tbody>
			</table>
				</div>
				<script src="js/scriptKt.js"> </script>
</body>
</html>	
