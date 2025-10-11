<?php
include "koneksi.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  if (isset($_POST['submit_aspirasi'])) {
      $nama_lengkap = $conn->real_escape_string(trim($_POST['nama_lengkap']));
      $nim = $conn->real_escape_string(trim($_POST['nim']));
      $angkatan = $conn->real_escape_string(trim($_POST['angkatan']));
      $topik_permasalahan = (int) $_POST['topik_permasalahan'];
      $kritik = $conn->real_escape_string(trim($_POST['kritik']));
      $saran = $conn->real_escape_string(trim($_POST['saran']));

      $sql = "INSERT INTO Aspirasi (nama_lengkap, nim, angkatan, topik_permasalahan_id, kritik, saran)
        VALUES ('$nama_lengkap', '$nim', '$angkatan', $topik_permasalahan, '$kritik', '$saran')";

      if ($conn->query($sql) === TRUE) {
        echo "<script>
          alert('Aspirasi berhasil dikirim!! Terima kasih atas partisipasinya yaww!');
        window.location.href='table.php';
      </script>";
    } else {
      echo "<script>
        alert('Waduh. Sepertinya aspirasi gagal dikirim nih!: " . $conn->error . "');
      window.history.back();  
      </script>";
    }
  } elseif (isset($_POST['submit_login'])) {
      $nama = $conn->real_escape_string(trim($_POST['nama']));
      $password = trim($_POST['password']);

      $sql = "SELECT * FROM Admin WHERE nama = '$nama' LIMIT 1";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password == $row['password']) {
          $_SESSION['admin_id'] = $row['id'];
          $_SESSION['admin_nama'] = $row['nama'];

          echo "<script>
            alert('Login berhasil! Selamat datang, " . htmlspecialchars($row['nama']) . "');
            window.location.href = 'index.php';
          </script>";
        } else {
          echo "<script>
            alert('nama/password salah!');
            window.history.back();
          </script>";
        }
      } else {
        echo "<script>
          alert('nama/password salah!');
          window.history.back();
        </script>";
      }
  } elseif (isset($_POST['submit_logout'])) {
      session_unset();
      session_destroy();
      header("Location: index.php");
  } elseif (isset($_POST['edit_admin'])) {
      $id = intval($_POST['id']);
      $nama = $conn->real_escape_string(trim($_POST['nama']));

      $sql = "UPDATE Admin SET nama = '$nama' WHERE id = $id";

      if ($conn->query($sql) === TRUE) {
        echo "<script>
          alert('Nama admin berhasil diperbarui!');
          window.location.href='kelola_akun.php';
        </script>";
      } else {
        echo "<script>
          alert('Gagal memperbarui admin: " . $conn->error . "');
          window.history.back();
        </script>";
      }
  } elseif (isset($_POST['submit_tambah_admin'])) {
    $nama = $conn->real_escape_string(trim($_POST['nama']));
    $password = $_POST['password'];

    $sql = "INSERT INTO Admin (nama, password) VALUES ('$nama', '$password')";
    if ($conn->query($sql) === TRUE) {
      echo "<script>
        alert('Admin baru berhasil ditambahkan!');
        window.location.href='kelola_akun.php';
      </script>";
    } else {
      echo "<script>
        alert('Gagal menambahkan admin: " . $conn->error . "');
        window.history.back();
      </script>";
    }
  } elseif (isset($_POST['submit_tambah_topik'])) {
      $judul = $conn->real_escape_string(trim($_POST['judul']));
      $sql = "INSERT INTO TopikPermasalahan (judul) VALUES ('$judul')";
      if ($conn->query($sql)) {
        echo "<script>alert('Topik berhasil ditambahkan!'); window.location='kelola_topik.php';</script>";
      } else {
        echo "<script>alert('Gagal menambah topik: " . $conn->error . "'); window.history.back();</script>";
      }
  } elseif (isset($_POST['edit_topik'])) {
      $id = intval($_POST['id']);
      $judul = $conn->real_escape_string(trim($_POST['judul']));
      $sql = "UPDATE TopikPermasalahan SET judul='$judul' WHERE id=$id";

      if ($conn->query($sql)) {
        echo "<script>alert('Topik berhasil diubah!'); window.location='kelola_topik.php';</script>";
      } else {
        echo "<script>alert('Gagal mengubah topik: " . $conn->error . "'); window.history.back();</script>";
      }
  } elseif (isset($_POST['submit_edit_aspirasi'])) {
    $id = intval($_POST['id']);
    $status = $conn->real_escape_string($_POST['status']);
    $pihak = $conn->real_escape_string($_POST['pihak_terkait']);
    $hasil = $conn->real_escape_string($_POST['hasil']);

    $sql = "UPDATE Aspirasi SET 
            status ='$status',
            pihak_terkait ='$pihak', 
            hasil = '$hasil'
            WHERE id = $id";

    if ($conn->query($sql)) {
      echo "<script>alert('Aspirasi berhasil diperbarui!'); window.location='kelola_aspirasi.php';</script>";
    } else {
      echo "<script>alert('Gagal memperbarui aspirasi: " . $conn->error . "'); window.history.back();</script>";
    }
  }
}

if (isset($_GET['id_admin_delete'])) {
  $id = intval($_GET['id_admin_delete']);

  $sql = "DELETE FROM Admin WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo "<script>
      alert('Admin berhasil dihapus!');
      window.location.href='kelola_akun.php';
    </script>";
  } else {
    echo "<script>
      alert('Gagal menghapus admin: " . $conn->error . "');
      window.history.back();
    </script>";
  }
}

if (isset($_GET['hapus_topik'])) {
  $id = intval($_GET['hapus_topik']);
  $sql = "DELETE FROM TopikPermasalahan WHERE id=$id";

  if ($conn->query($sql)) {
    echo "<script>alert('Topik berhasil dihapus!'); window.location='kelola_topik.php';</script>";
  } else {
    echo "<script>alert('Gagal menghapus topik: " . $conn->error . "'); window.history.back();</script>";
  }
}

if (isset($_GET['hapus_aspirasi'])) {
  $id = intval($_GET['hapus_aspirasi']);

  $sql = "DELETE FROM Aspirasi WHERE id=$id";
  if ($conn->query($sql)) {
    echo "<script>alert('Aspirasi berhasil dihapus!'); window.location='kelola_aspirasi.php';</script>";
  } else {
    echo "<script>alert('Gagal menghapus aspirasi: " . $conn->error . "'); window.history.back();</script>";
  }
}

$conn->close();
?>
