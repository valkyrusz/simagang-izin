<?php
//memanggil file pustaka fungsi
require "fungsi.php";

//memindahkan data kiriman dari form ke var biasa
$nim = $_POST["nim"];
$nama = $_POST["nama"];
$email = $_POST["email"];
$uploadOk = 1;

//Set lokasi dan nama file foto
$folderupload = "foto/";

$extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
$new_filename = uniqid() . "." . $extension;
$fileupload = $folderupload . $new_filename;

// Check ukuran file
if ($_FILES["foto"]["size"] > 1000000) {
    echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
    $uploadOk = 0;
}

// Hanya file tertentu yang dapat digunakan
if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
    $uploadOk = 0;
}

// Check jika terjadi kesalahan
if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat terupload<br>";
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
        //membuat query
        $sql = "INSERT INTO mhs (nim, nama, email, foto) VALUES ('$nim', '$nama', '$email', '$new_filename')";
        if (mysqli_query($koneksi, $sql)) {
            header("location:tambah.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload file foto<br>";
    }
}
