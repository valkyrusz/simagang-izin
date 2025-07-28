<?php
require 'fungsi.php'; // Pastikan koneksi database terhubung

if (isset($_POST['nim'])) {
  $nim = $_POST['nim'];
  $query = "SELECT COUNT(*) AS count FROM mhs WHERE nim = ?";
  $stmt = $koneksi->prepare($query);
  $stmt->bind_param("s", $nim);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row['count'] > 0) {
    echo 'exists'; // Jika data kembar
  } else {
    echo 'not_exists'; // Jika data belum ada
  }
} else {
  echo 'invalid_request';
}

$stmt->close();
$koneksi->close();
?>
