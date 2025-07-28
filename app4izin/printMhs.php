<!DOCTYPE html>
<html>
<head>
	 <title>Laporan</title>
</head>
<body>
			<style type="text/css">
						body{
						font-family: sans-serif;
						}
						table{
						margin: 20px auto;
						border-collapse: collapse;
						}
						table th,
						table td{
						border: 1px solid #3c3c3c;
						padding: 3px 8px;

						}
						a{
						background: blue;
						color: #fff;
						padding: 8px 10px;
						text-decoration: none;
						border-radius: 2px;
						}

							.tengah{
								text-align: center;
							}
			</style>
	<table>
	<tr>
	<th>No.</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Universitas</th>
						<th>Program Studi</th>
						<th>Tanggal Izin</th>
						<th>Foto</th>
						<th>Keterangan</th>
	</tr>
	<?php 
	// koneksi  database
	$koneksi = mysqli_connect("localhost","root","","magangmhs");

	// menampilkan data pegawai
	$data = mysqli_query($koneksi,"select * from mhsdiskominfo");
	while($d = mysqli_fetch_array($data)){
	?>
	<tr>
	<td style='text-align: center;'><?php echo $d['id'] ?></td>
	<td><?php echo $d['nim']; ?></td>
	<td><?php echo $d['nama']; ?></td>
	<td><?php echo $d['univ']; ?></td>
	<td><?php echo $d['prodi']; ?></td>
	<td><?php echo $d['tgl']; ?></td>
	<td><img src="<?php echo "foto/".$row["foto"]?>" height="50"></td>
	<td><?php echo $d['ket']; ?></td>
	</tr>
	<?php 
	}
	?>
		</table>
		<script>
	window.print();
	</script>
</body>
</html>