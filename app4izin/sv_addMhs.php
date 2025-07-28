<?php
require "fungsi.php";

if (isset($_POST['check_nim'])) {
    $nim = $_POST['nim'];

    $query = "SELECT * FROM mhsdiskominfo WHERE nim = '$nim'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'exists'; 
    } else {
        echo 'not_exists'; 
    }
    exit(); 
}

$nim = $_POST["nim"];
$nama = $_POST["nama"];
$univ = $_POST["univ"];
$prodi = $_POST["prodi"];
$tgl = $_POST["tgl"];
$ket = $_POST["ket"];
$uploadOk = 1;

$folderupload = "foto/";
$extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
$new_filename = uniqid() . "." . $extension;
$fileupload = $folderupload . $new_filename;

$query_check = "SELECT * FROM mhsdiskominfo WHERE nim = '$nim'";
$result_check = mysqli_query($koneksi, $query_check);
if (mysqli_num_rows($result_check) > 0) {
    echo "NIM sudah ada di database!";
    exit;
}

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
        // Insert data into the database
        $sql = "INSERT INTO mhsdiskominfo (nim, nama, univ, prodi, tgl , foto, ket) VALUES ('$nim', '$nama', '$univ', '$prodi', '$tgl' '$new_filename', '$ket')";
        if (mysqli_query($koneksi, $sql)) {
            header("location:ajaxUpdateMhs.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload file foto<br>";
    }
}
