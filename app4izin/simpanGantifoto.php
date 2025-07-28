<?php
//panggil file fungsi
require "fungsi.php";

$id = $_POST['id'];
$folderupload = "foto/";
$uploadOk = 1;

$sql = "SELECT foto FROM mhs WHERE id='$id'";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);
$old_foto = $row['foto'];

$extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
$new_filename = uniqid() . "." . $extension;
$fileupload = $folderupload . $new_filename;

if ($_FILES["foto"]["size"] > 1000000) {
	echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
	$uploadOk = 0;
}

if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
	echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
	$uploadOk = 0;
}


if ($uploadOk == 0) {
	echo "Maaf, file tidak dapat terupload<br>";
} else {
	if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
		// Update the database with the new filename
		$sql = "UPDATE mhs SET foto='$new_filename' WHERE id='$id'";
		if (mysqli_query($koneksi, $sql)) {
			// Delete the old photo if it exists
			if ($old_foto && file_exists($folderupload . $old_foto)) {
				unlink($folderupload . $old_foto);
			}
			header("location:homeadmin.php");
		} else {
			echo "Error updating record: " . mysqli_error($koneksi);
		}
	} else {
		echo "Maaf, terjadi kesalahan saat mengupload file foto<br>";
	}
}
