CREATE DATABASE serap_aspirasi;

USE serap_aspirasi;

CREATE TABLE Admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE TopikPermasalahan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Aspirasi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap VARCHAR(100) NOT NULL,
  nim VARCHAR(20) NOT NULL,
  angkatan YEAR NOT NULL,
  topik_permasalahan_id INT NOT NULL,
  kritik TEXT,
  saran TEXT,
  status ENUM('terbaca', 'belum dibaca') DEFAULT 'belum dibaca',
  pihak_terkait VARCHAR(100),
  hasil TEXT,
  tanggal_dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_topik_permasalahan
    FOREIGN KEY (topik_permasalahan_id)
    REFERENCES TopikPermasalahan(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO Admin (nama, password) VALUES 
('admin', '12345');

INSERT INTO TopikPermasalahan (judul) VALUES
('Civitas Akademik'),
('Fasilitas'),
('Organisasi Mahasiswa'),
('Himpunan Prodi'),
('UKM'),
('UKT'),
('Sarana Prasarana'),
('Lainnya');
