<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$id = $_GET["kode"];

$sql = "SELECT foto FROM mhsdiskominfo WHERE id=$id";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$foto = $row['foto'];

//membuat query hapus data
$sql = "DELETE FROM mhsdiskominfo WHERE id=$id";
if (mysqli_query($koneksi, $sql)) {
    // If the record is successfully deleted, delete the photo
    if ($foto && file_exists("foto/" . $foto)) {
        unlink("foto/" . $foto);
    }
    header("location:ajaxUpdateMhs.php");
} else {
    echo "Error deleting record: " . mysqli_error($koneksi);
}
