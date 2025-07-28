<?php
//memanggil file berisi fungsi2 yang sering dipakai
require "../fungsi.php";
require "../head.html";
$keyword = $_GET["keyword"];
$jmlDataPerHal = 7;

//--------- konfigurasi pencarian data
$sql = "SELECT * FROM matkul WHERE idmatkul LIKE '%$keyword%' OR
                     namamatkul LIKE '%$keyword%' OR
                     sks LIKE '%$keyword%' OR
                     jns LIKE '%$keyword%' OR
                     smt LIKE '%$keyword%'";
$qry = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
$jmlData = mysqli_num_rows($qry);

$jmlHal = ceil($jmlData / $jmlDataPerHal);
if (isset($_GET['hal'])) {
    $halAktif = $_GET['hal'];
} else {
    $halAktif = 1;
}

$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

//Jika tabel data kosong
$kosong = false;
if (!$jmlData) {
    $kosong = true;
}

// Klausa LIMIT untuk membatasi jumlah baris
$sql = "SELECT * FROM matkul WHERE idmatkul LIKE '%$keyword%' OR
                     namamatkul LIKE '%$keyword%' OR
                     sks LIKE '%$keyword%' OR
                     jns LIKE '%$keyword%' OR
                     smt LIKE '%$keyword%'
                     LIMIT $awalData, $jmlDataPerHal";

//Ambil data untuk ditampilkan
$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
?>

<!-- Cetak data dengan tampilan tabel -->
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>No.</th>
            <th>ID Matkul</th>
            <th>Nama</th>
            <th>SKS</th>
            <th>Jenis</th>
            <th>Semester</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($hasil)) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row["idmatkul"]; ?></td>
                <td><?php echo $row["namamatkul"]; ?></td>
                <td><?php echo $row["sks"]; ?></td>
                <td><?php echo $row["jns"]; ?></td>
                <td><?php echo $row["smt"]; ?></td>
                <td>
                    <a class="btn btn-outline-primary btn-sm" href="editMkul.php?kode=<?php echo $row['idmatkul']; ?>">Edit</a>
                    <a class="btn btn-outline-danger btn-sm" href="hpsMkul.php?kode=<?php echo $row['idmatkul']; ?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
