<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$id=$_POST["id"];
$nama=$_POST["nama"];
$univ=$_POST["univ"];
$uploadOk=1;

//membuat query
$sql="update mhsdiskominfo set nama='$nama',
					 univ='$univ'
					 where id='$id'";
mysqli_query($koneksi,$sql) or die(mysqli_error($koneksi));
header("location:ajaxUpdateMhs.php");
?>