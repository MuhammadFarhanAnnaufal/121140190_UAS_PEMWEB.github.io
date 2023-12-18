<?php
include ('koneksi.php');

function getMahasiswa($conn, $program_studi = null)
{
    $sql = "SELECT * FROM data_mahasiswa";
    if ($program_studi) {
        $sql .= " WHERE program_studi = '$program_studi'";
    }

    $result = mysqli_query($conn, $sql);

    $data_mahasiswa = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data_mahasiswa[] = $row;
    }

    return $data_mahasiswa;
}

function tambahMahasiswa($conn, $nama, $nim, $program_studi, $alamat_domisili)
{
    $sql = "INSERT INTO data_mahasiswa (nama, nim, program_studi, alamat domisili) VALUES ('$nama', '$nim', '$program_studi', '$alamat_domisili)";
    return mysqli_query($conn, $sql);
}

function hapusMahasiswa($conn, $id)
{
    $sql = "DELETE FROM data_mahasiswa WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function editMahasiswa($conn, $id, $nama, $nim, $program_studi, $alamat_domisili)
{
    $sql = "UPDATE data_mahasiswa SET nama = '$nama', nim = '$nim', program_studi = '$program_studi', alamat_domisili = '$alamat_domisili' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$program_studi = isset($_GET['program_studi']) ? $_GET['program_studi'] : '';

if ($aksi == 'tambah' && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];
    $alamat_domisili = $_POST['alamat_domisili'];

    tambahMahasiswa($conn, $nama, $nim, $program_studi, $alamat_domisili);
    header("Location: index.php");
}

if ($aksi == 'edit' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];
    $alamat_domisili = $_POST['alamat_domisili'];

    editMahasiswa($conn, $id, $nama, $nim, $program_studi, $alamat_domisili);
    header("Location: index.php");
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    hapusMahasiswa($conn, $id);
    header("Location: index.php");
}

$data_mahasiswa = getMahasiswa($conn, $program_studi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>121140190_UAS PEMWEB</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="fContainer" id="top">
        <nav class="wrapper">
            <div class="brand">
            <div class="firstname">FARHAN</div>
            <div class="lastname">121140190</div>
    </div>
            <ul class="navigation">
                <li><a href="index.php#top">BERANDA</a></li>
                <li><a href="index.php#formulir">FORMULIR</a></li>
                <li><a href="index.php#hasil">HASIL</a></li>
                <li><img src="asset/FOTO_PROFILE.png" alt="Foto Saya"></li>
            </ul>
        </nav>
    </div>

    <div class="content">
    <div class="text">
        <br><br>
      <h1>UAS</h1>
      <h1>Pemrograman Web</h1> <br>
      <p>Selamat Datang,</p>
      <p id="nama_saya">Perkenalkan Nama Saya Muhammad Farhan Annaufal</p>
      <p id="nim_saya">NIM 121140190</p>
      <p id="kelas_saya">Dari Kelas Pemrograman Web RA</p>
    </div>
    </div>
    <div class="container" id="hasil">
        <h1>Data Kepanitiaan Event ITERA OPEN 2023</h1>

        <form action="index.php" method="get">
            <label for="program_studi">Sortir berdasarkan Program Studi:</label>
            <select name="program_studi" id="program_studi" onchange="this.form.submit()">
                <option value="">Semua Program Studi</option>
                <option value="Teknik Informatika" <?php echo ($program_studi == 'Teknik Informatika') ? 'selected' : ''; ?>> Teknik Informatika</option>
                <option value="Teknik Industri" <?php echo ($program_studi == 'Teknik Industri') ? 'selected' : ''; ?>>Teknik Industri</option>
                <option value="Rekayasa Kehutanan" <?php echo ($program_studi == 'Rekayasa Kehutanan') ? 'selected' : ''; ?>>Rekayasa Kehutanan</option>
                <option value="Teknik Sipil" <?php echo ($program_studi == 'Teknik Sipil') ? 'selected' : ''; ?>>Teknik Sipil</option>
            </select>
        </form>

        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Alamat Domisili</th>
                <th>Menu</th>
            </tr>
            <?php foreach ($data_mahasiswa as $mhs) : ?>
                <tr>
                <td><?php echo $mhs['nama']; ?></td>
                <td><?php echo $mhs['nim']; ?></td>
                <td><?php echo $mhs['program_studi']; ?></td>
                <td><?php echo $mhs['alamat_domisili']; ?></td>
                <td>
                    <form action="hapusdata.php" method="get">
                        <input type="hidden" name="del" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                    <form action="editdata.php" method="get">
                        <input type="hidden" name="edit" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    </td>
                 </tr>
            <?php endforeach; ?>
        </table>
    </form>
    <form action="tambahdata.php" method="post" id="formulir">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>
    <label for="nim">NIM:</label>
    <input type="text" name="nim" required>
    <label for="program_studi">Program Studi:</label>
    <input type="text" name="program_studi" required>
    <label for="alamat_domisili">Alamat Domisili:</label>
    <input type="text" name="alamat_domisili" required>
    <input type="submit" value="Tambahkan">
    </form>
    </div>

    <div class="quote">
    <p><b><i>"quamvis infirmus sum, fines no sum"</i></b></p>
    <p>tidak peduli seberapa lemah saya, saya tidak memiliki batasan.</p>
  </div>

  <div class="kontak">
    <div class="kontak-item">
      <a href="https://www.instagram.com/farhan_annaufal21/">
        <img class="gambar" src="asset/instagram png.png" alt="Instagram Saya">
      </a>
      <p class="caption">farhan_annaufal21</p>
    </div>
    <div class="kontak-item">
      <img class="gambar" src="asset/whatsapp png.png" alt="WhatsApp Saya">
      <p class="caption">0895621241391</p>
    </div>
    <div class="kontak-item">
      <a href="https://www.linkedin.com/in/MuhammadFarhanAnnaufal/">
        <img class="gambar" src="asset/linkedin png.png" alt="LinkedIn Saya">
      </a>
      <p class="caption">Muhammad Farhan Annaufal</p>
    </div>
  </div>

  <footer>
    <p align="center">Muhammad Farhan Annaufal<sup>©</sup> 2023</p>
  </footer>

  <div class="manipulasi_dom">
    <h3>Penerapan Manipulasi DOM</h3>
    <button onclick="ubahNama()">Ubah Nama</button>
    <button onclick="ubahNIM()">Ubah NIM</button>
    <button onclick="ubahKelas()">Ubah Kelas</button>
  </div>

</body>

<script>
  // Fungsi untuk mengubah judul
  function ubahNama() {
    var judul = document.getElementById("nama_saya");
    judul.innerHTML = "Perkenalkan Nama Saya ........................";
  }

  function ubahNIM() {
    var judul = document.getElementById("nim_saya");
    judul.innerHTML = "NIM .........";
  }

  function ubahKelas() {
    var judul = document.getElementById("kelas_saya");
    judul.innerHTML = "Dari Kelas Pemrograman Web .....";
  }

</script>

</html>
