CREATE TABLE data_mahasiswa (
    nomer INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nim VARCHAR(15) UNIQUE,
    program_studi VARCHAR(70),
    alamat_domisili VARCHAR(100)
);

INSERT INTO data_mahasiswa (nama, nim, program_studi, alamat_domisili) VALUES
('Muhammad Farhan Annaufal', '121140190', 'Teknik Informatika', 'way Kandis'),
('Nanda Dwi Setiawan', '121210029', 'Teknik Sipil', 'Airan Raya'),
('Rafli Ahmad Maulana', '122420156', 'Rekayasa Kehutanan','Way Kandis'),
('Muhammad Fabil', '121140189', 'Teknik Informatika', 'Pemda Way Huwi'),
('Rizkia Desta Fitriani', '121190017', 'Teknik Industri', 'Pemda Way Huwi');