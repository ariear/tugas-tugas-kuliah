CREATE DATABASE serap_aspirasi;

CREATE TABLE Aspirasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL,
    angkatan YEAR NOT NULL,
    topik_permasalahan VARCHAR(255) NOT NULL,
    kritik TEXT,
    saran TEXT,
    status ENUM('terbaca', 'belum dibaca') DEFAULT 'belum dibaca',
    tanggal_dibuat TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
