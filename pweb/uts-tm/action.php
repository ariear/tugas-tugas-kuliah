<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama_lengkap = $conn->real_escape_string(trim($_POST['nama_lengkap']));
  $nim = $conn->real_escape_string(trim($_POST['nim']));
  $angkatan = $conn->real_escape_string(trim($_POST['angkatan']));
  $topik_permasalahan = $conn->real_escape_string(trim($_POST['topik_permasalahan']));
  $kritik = $conn->real_escape_string(trim($_POST['kritik']));
  $saran = $conn->real_escape_string(trim($_POST['saran']));

  $sql = "INSERT INTO Aspirasi (nama_lengkap, nim, angkatan, topik_permasalahan, kritik, saran)
          VALUES ('$nama_lengkap', '$nim', '$angkatan', '$topik_permasalahan', '$kritik', '$saran')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Aspirasi berhasil dikirim!! Terima kasih atas partisipasinya yaww!'); window.location.href=document.referrer;</script>";
  } else {
    echo "<script>alert('Waduh. Sepertinya aspirasi gagal dikirim nih!: " . $conn->error . "'); window.history.back();</script>";
  }
}

$conn->close();
?>
