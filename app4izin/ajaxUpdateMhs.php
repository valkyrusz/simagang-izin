<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
	<head class ="header">
		<title>Sistem Informasi Magang::Daftar Perizinan</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="bootstrap-5.1.3-dist/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/stylekuu.css">
		<script src="bootstrap-5.1.3-dist/jquery/3.3.1/jquery-3.3.1.js"></script>
		<script src="bootstrap-5.1.3-dist/js/bootstrap.js"></script>
		<!-- Use fontawesome 5-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
	</head>
	<style>/* 
 * Stylesheet untuk Daftar Penawaran Mata Kuliah
 */

/* Variabel */
:root {
  --warna-utama: #1976d2;
  --warna-secundar: #f1c40f;
  --warna-bg: #f9f9f9;
}

/* Global */
body {
  font-family: Arial, sans-serif;
  background: linear-gradient(to bottom right, #e3f2fd, #ffffff); /* Biru muda ke putih */
  margin: 0;
  padding: 0;
}

/* Header */
.header {
  background-color: var(--warna-utama);
  color: #fff;
  padding: 20px;
  text-align: center;
}

/* Konten */


/* Tabel */
/* Tabel */
.table {
  border-collapse: separate; /* Agar border-radius bekerja */
  border-spacing: 0; /* Hilangkan jarak antar sel */
  width: 100%;
  border: 1px solid #ddd; /* Tambahkan border tipis */
  border-radius: 10px; /* Ujung tabel membulat */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan lembut */
  overflow: hidden; /* Untuk memastikan border-radius berlaku */
}

/* Header Tabel */
.table th {
  background-color: #1976d2; /* Warna biru segar */
  color: #fff; /* Warna teks putih */
  padding: 12px;
  text-align: center;
  font-weight: bold;
  border-bottom: 2px solid #1565c0; /* Garis pemisah header */
}

/* Isi Tabel */
.table td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd; /* Garis pemisah antar sel */
  background-color: #fff; /* Warna putih segar */
}

/* Baris Tabel Striped */
.table tr:nth-child(even) td {
  background-color: #f9f9f9; /* Warna abu-abu terang untuk baris genap */
}

/* Hover Effect */
.table tr:hover td {
  background-color: #e3f2fd; /* Warna biru terang saat hover */
  transition: background-color 0.3s ease;
}

/* Untuk Border Radius agar berlaku di seluruh tabel */
.table thead th:first-child {
  border-top-left-radius: 10px;
}
.table thead th:last-child {
  border-top-right-radius: 10px;
}
.table tbody tr:last-child td:first-child {
  border-bottom-left-radius: 10px;
}
.table tbody tr:last-child td:last-child {
  border-bottom-right-radius: 10px;
}

}

/* Pagination */
.pagination {
  margin-top: 20px;
}

.pagination li {
  display: inline-block;
  margin-right: 10px;
}

.pagination li a {
  text-decoration: none;
  color: var(--warna-utama);
}

.pagination li a:hover {
  color: var(--warna-secundar);
}

/* Tombol */
.btn {
  background-color: var(--warna-utama);
  color: #fff;
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.btn:hover {
  background-color: var(--warna-secundar);
}

.contact-info {
    background-color: #f1f1f1; /* Warna latar belakang */
    padding: 20px; /* Ruang di dalam */
    border-radius: 10px; /* Sudut membulat */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
    margin: 20px auto; /* Margin atas dan bawah */
    max-width: 400px; /* Lebar maksimum */
		text-align:center;
}

.contact-id {
    font-size: 24px; /* Ukuran font untuk ID */
    color: #1976d2; /* Warna teks */
}

.contact-name {
    font-size: 20px; /* Ukuran font untuk nama */
    font-weight: bold; /* Teks tebal */
    color: #333; /* Warna teks */
}

.contact-class {
    font-size: 18px; /* Ukuran font untuk kelas */
    color: #555; /* Warna teks */
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
			$jmlDataPerHal = isset($_POST['items_per_page']) ? $_POST['items_per_page'] : 7;

			//pencarian data
			if (isset($_POST['cari'])){
				$cari=$_POST['cari'];
				$sql="select * from mhsdiskominfo where nim like'%$cari%' or
									nama like '%$cari%' or
									univ like '%$cari%'";
			}else{
				$sql="select * from mhsdiskominfo";		
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
				$sql="select * from mhsdiskominfo where nim like'%$cari%' or
									nama like '%$cari%' or
									univ like '%$cari%'
									limit $awalData,$jmlDataPerHal";
			}else{
				$sql="select * from mhsdiskominfo limit $awalData,$jmlDataPerHal";		
			}

			//Ambil data untuk ditampilkan
			$hasil=mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));

		?>
		<main class="utama">
			<h2 class="text-center">Daftar Perizinan</h2>
			<div class="text-center"><a href="printMhs.php"><span class="fas fa-print">&nbsp;Print</span></a></div>
			<span class="float-left">
				<a class="btn btn-success" href="addMhs.php">Tambah Data</a>
			</span>
			
			<!-- Dropdown untuk memilih jumlah item per halaman -->
			<form class="d-flex" action="" method="POST" style="float:right; margin-bottom: 20px;">
				<select name="items_per_page" class="form-select" onchange="this.form.submit()">
					<option value="5" <?php if($jmlDataPerHal == 5) echo 'selected'; ?>>5</option>
					<option value="10" <?php if($jmlDataPerHal == 10) echo 'selected'; ?>>10</option>
					<option value="15" <?php if($jmlDataPerHal == 15) echo 'selected'; ?>>15</option>
					<option value="20" <?php if($jmlDataPerHal == 20) echo 'selected'; ?>>20</option>
				</select>
			</form>


			<form class="d-flex" action="" method="POST" style="float:right;">
        		<button class="btn btn-outline-success"  type="submit"name="cari" id="tombol-cari">Cari</button>
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari"id="keyword">
				</form>
			</span>
			<br><br>


		<div id="container">		
			<!-- Cetak data dengan tampilan tabel -->
			<table class="table table-hover">
				<thead class="thead-light">
					<tr>
						<th>No.</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Universitas</th>
						<th>Program Studi</th>
						<th>Tanggal Izin</th>
						<th>Foto</th>
						<th>Keterangan</th>
						<th>Tombol Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
						//jika data tidak ada
						if ($kosong){
					?>
						<tr><th colspan="16">
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
							<td><?php echo $row["nim"]?></td>
							<td><?php echo $row["nama"]?></td>
							<td><?php echo $row["univ"]?></td>
							<td><?php echo $row["prodi"]?></td>
							<td><?php echo $row["tgl"]?></td>
							<td><img src="<?php echo "foto/".$row["foto"]?>" height="50"></td>
							<td><?php echo $row["ket"]?></td>
							<td>
								<a class="btn btn-outline-primary btn-sm" href="editMhs.php?kode=<?php echo $row['id']?>">Edit</a>
								<a class="btn btn-outline-danger btn-sm mt-1" href="hpsMhs.php?kode=<?php echo $row["id"]?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
							</td>
						</tr>
								<?php 
									$no++;
						}
					}
							?>
				</tbody>
				</main>
			</table>
			<ul class="pagination justify-content-center">
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
	<script src="js/script.js"> </script>

<script src="js/script.js"> </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {

      // Handler untuk tombol hapus dengan AJAX
      $('.btn-outline-danger').on('click', function(e) {
        e.preventDefault(); // Mencegah link default

        var deleteLink = $(this).attr('href'); // Ambil URL hapus
        var row = $(this).closest('tr'); // Simpan referensi baris yang akan dihapus

        // Konfirmasi sebelum menghapus
        if (confirm('Yakin dihapus nih?')) {
          $.ajax({
            url: deleteLink,
            type: 'GET',
            success: function(response) {
              // Hapus baris dari tabel
              row.remove();

              // Refresh pagination atau perbarui jumlah data
              refreshPaginationAndCount();
            },
            error: function() {
              alert('Gagal menghapus data');
            }
          });
        }
      });

      // Fungsi untuk menyesuaikan nomor urut dan pagination setelah hapus
      function refreshPaginationAndCount() {
        // Perbarui nomor urut
        $('.table tbody tr').each(function(index) {
          $(this).find('td:first').text(index + 1);
        });

        // Perbarui total data
        var totalRows = $('.table tbody tr').length;

        // Jika data kosong, tampilkan pesan
        if (totalRows === 0) {
          $('.table tbody').html(`
                <tr>
                    <th colspan="6">
                        <div class="alert alert-info alert-dismissible fade show text-center">
                            Data tidak ada
                        </div>
                    </th>
                </tr>
            `);
        }
      }
    });
  </script>
</div>
</body>
</html>	
