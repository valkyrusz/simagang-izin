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
$foto = $_FILES["foto"]["name"] ?? '';
if (empty($nim) || empty($nama) || empty($univ) || empty($prodi) || empty($tgl) || empty($ket)) {
    echo "Semua field harus diisi!";
    exit;
}
$uploadOk = 1;



$folderupload = "foto/";
$extension = '';
if (!empty($_FILES['foto']['name'])) {
    $extension = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
}
$new_filename = uniqid() . ($extension ? "." . $extension : "");
$fileupload = $folderupload . $new_filename;

$stmt_check = mysqli_prepare($koneksi, "SELECT * FROM mhsdiskominfo WHERE nim = ?");
mysqli_stmt_bind_param($stmt_check, "s", $nim);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);
if (mysqli_num_rows($result_check) > 0) {
    echo "NIM sudah ada di database!";
if (isset($_FILES["foto"]["size"]) && $_FILES["foto"]["size"] > 1000000) {
    echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
    $uploadOk = 0;
}
    echo "Maaf, ukuran file foto harus kurang dari 1 MB<br>";
    $uploadOk = 0;
}

$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
if (!in_array($extension, $allowed_extensions)) {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan<br>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Maaf, file tidak dapat terupload<br>";
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $fileupload)) {
        // Insert data into the database
        $sql = "INSERT INTO mhsdiskominfo (nim, nama, univ, prodi, tgl, ket, foto) VALUES ('$nim', '$nama', '$univ', '$prodi', '$tgl', '$ket', '$fileupload')";
        if (mysqli_query($koneksi, $sql)) {
            header("location:ajaxUpdateMhs.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload file foto<br>";
    }
}
