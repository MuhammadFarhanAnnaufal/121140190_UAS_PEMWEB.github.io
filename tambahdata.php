<?php
include ('koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];
    $alamat_domisili = $_POST['alamat_domisili'];

    $query = "INSERT INTO data_mahasiswa (nama,nim,program_studi,alamat_domisili) VALUES ('$nama','$nim','$program_studi','$alamat_domisili')";

    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Data berhasil ditambahkan.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>