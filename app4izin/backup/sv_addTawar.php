<?php
// Memanggil file pustaka fungsi untuk koneksi database
require "fungsi.php";

// Memindahkan data kiriman dari form ke variabel biasa
$idmatkul = $_POST["idmatkul"];
$npp = $_POST["npp"];
$klp = $_POST["klp"];
$hari = $_POST["hari"];
$jamkul = $_POST["jamkul"];
$ruang = $_POST["ruang"];

// Menyiapkan query untuk memasukkan data ke tabel kultawar
$sql = "INSERT INTO kultawar (idmatkul, npp, klp, hari, jamkul, ruang) 
        VALUES ('$idmatkul', '$npp', '$klp', '$hari', '$jamkul', '$ruang')";

// Eksekusi query dan cek apakah berhasil
if (mysqli_query($koneksi, $sql)) {
    echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'updateTawar.php';
          </script>";
} else {
    echo "<script>
            alert('Data gagal ditambahkan: " . mysqli_error($koneksi) . "');
            document.location.href = 'addTawar.php';
          </script>";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
