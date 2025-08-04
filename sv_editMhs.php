<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$id=$_POST["id"];
$nim=$_POST["nim"];
$nama=$_POST["nama"];
$univ=$_POST["univ"];
$prodi=$_POST["prodi"];
$tgl=$_POST["tgl"];
$ket=$_POST["ket"];

$uploadOk=1;

//membuat query
$sql="update mhsdiskominfo set nim='$nim',
					 nama='$nama',
					 univ='$univ',
					 prodi='$prodi',
					 tgl='$tgl',
					 ket='$ket'
					 where id='$id'";
mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
header("location:ajaxUpdateMhs.php");
?>