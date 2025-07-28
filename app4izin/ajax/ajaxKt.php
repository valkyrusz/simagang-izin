<?php
// Memanggil file berisi fungsi-fungsi yang sering dipakai
require "../fungsi.php";
require "../head.html";

$keyword = $_GET["keyword"];
$jmlDataPerHal = 100;

// Konfigurasi pencarian data dengan operasi relasi tabel
$sql = "SELECT k.idkultawar, m.namamatkul, d.namadosen, k.hari, k.jamkul
        FROM kultawar AS k
        JOIN matkul AS m ON k.idmatkul = m.idmatkul
        JOIN dosen AS d ON k.npp = d.npp
        WHERE m.namamatkul LIKE '%$keyword%' 
        OR d.namadosen LIKE '%$keyword%' 
        OR k.hari LIKE '%$keyword%' 
        OR k.jamkul LIKE '%$keyword%'";

$qry = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
$jmlData = mysqli_num_rows($qry);

$jmlHal = ceil($jmlData / $jmlDataPerHal);
if (isset($_GET['hal'])) {
    $halAktif = $_GET['hal'];
} else {
    $halAktif = 1;
}

$awalData = ($jmlDataPerHal * $halAktif) - $jmlDataPerHal;

// Jika tabel data kosong
$kosong = false;
if (!$jmlData) {
    $kosong = true;
}

// Klausa LIMIT untuk membatasi jumlah baris
$sql = "SELECT k.idkultawar, m.namamatkul, d.namadosen, k.hari, k.jamkul
        FROM kultawar AS k
        JOIN matkul AS m ON k.idmatkul = m.idmatkul
        JOIN dosen AS d ON k.npp = d.npp
        WHERE m.namamatkul LIKE '%$keyword%' 
        OR d.namadosen LIKE '%$keyword%' 
        OR k.hari LIKE '%$keyword%' 
        OR k.jamkul LIKE '%$keyword%' 
        LIMIT $awalData, $jmlDataPerHal";

// Ambil data untuk ditampilkan
$hasil = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
?>

<!-- Cetak data dengan tampilan tabel -->
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>Jadwal Hari</th>
            <th>Jadwal Jam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = $awalData + 1;
        while ($row = mysqli_fetch_assoc($hasil)) {
        ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row["namamatkul"] ?></td>
                <td><?php echo $row["namadosen"] ?></td>
                <td><?php echo $row["hari"] ?></td>
                <td><?php echo $row["jamkul"] ?></td>
                <td>
                    <a class="btn btn-outline-primary btn-sm" href="editKulTawar.php?kode=<?php echo $row['idkultawar']; ?>">Edit</a>
                    <a class="btn btn-outline-danger btn-sm" href="hpsKulTawar.php?kode=<?php echo $row['idkultawar']; ?>" id="linkHps" onclick="return confirm('Yakin dihapus nih?')">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
    </tbody>
</table>
