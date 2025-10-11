<?php
  include "koneksi.php";
  session_start();

  $sql = "SELECT a.*, t.judul AS topik_permasalahan
        FROM Aspirasi a
        LEFT JOIN TopikPermasalahan t ON a.topik_permasalahan_id = t.id
        ORDER BY a.tanggal_dibuat DESC";
  $result = $conn->query($sql);
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>SERAP ASPIRASI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: "class"
    }
  </script>
</head>

<body class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">
  <nav class="relative bg-green-700/80 after:pointer-events-none after:absolute after:inset-x-0 after:bottom-0 after:h-px after:bg-white/10">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <button id="menuToggle" type="button" class="bg-green-800 relative inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-white/5 hover:text-white focus:outline-2 focus:-outline-offset-1 focus:outline-indigo-500" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg id="iconOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg id="iconClose" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex shrink-0 items-center">
            <img src="assets/elaina-logo.png" alt="Your Company" class="h-9 w-auto" />
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <a href="index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white">Form Serap</a>
              <a href="table.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white">Daftar hasil Serap</a>
            </div>
          </div>
        </div>

        <?php if (isset($_SESSION['admin_id'])) { ?>
          <a href="kelola_akun.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Kelola Akun</a>
          <a href="kelola_aspirasi.php" class="rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Kelola Aspirasi</a>
          <a href="kelola_topik.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Kelola Topik</a>
          <form method="POST" action="action.php">
            <button type="submit" name="submit_logout" class="bg-red-400 rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Logout</button>
          </form>
        <?php } else {?>
          <a href="login.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Login Admin</a>
        <?php } ?>
        <button id="themeToggle" class="ml-4 p-2 rounded-md bg-white/10 hover:bg-white/20 text-white dark:text-yellow-300">
          <svg id="sunIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.485-8.485h1M3.515 12.515h1M17.657 6.343l.707.707M5.636 18.364l.707.707M17.657 17.657l.707-.707M5.636 5.636l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
          </svg>
          <svg id="moonIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21.752 15.002A9 9 0 0112.998 3a9 9 0 108.754 12.002z" />
          </svg>
        </button>
      </div>
    </div>

    <div id="mobileMenu" class="hidden sm:hidden">
      <div class="space-y-1 px-2 pt-2 pb-3">
        <a href="index.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Form Serap</a>
        <a href="table.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Daftar Hasil Serap</a>
        <?php if (isset($_SESSION['admin_id'])) { ?>
          <a href="kelola_akun.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Kelola Akun</a>
          <a href="kelola_aspirasi.php" class="block bg-gray-950/50 rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Kelola Aspirasi</a>
          <a href="kelola_topik.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Kelola Topik</a>
          <form method="POST" action="action.php">
            <button type="submit" name="submit_logout" class="block bg-red-400 rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Logout</button>
          </form>
        <?php } else {?>
          <a href="login.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Login Admin</a>
        <?php } ?>
      </div>
    </div>
  </nav>

  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 pt-10">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold mb-2">Kelola Aspirasi</h1>
        <p class="text-black/70 dark:text-white/80 mb-10">
          Di sini, admin dapat mengelola aspirasi dari mahasiswa
        </p>
      </div>
    </div>

    <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-sm">
      <table class="min-w-full text-sm text-gray-700 dark:text-white">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
          <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left">Nama Lengkap</th>
            <th class="px-4 py-3 text-left">NIM</th>
            <th class="px-4 py-3 text-left">Angkatan</th>
            <th class="px-4 py-3 text-left">Topik Permasalahan</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
              if ($row['status'] === 'terbaca') {
                $statusClass = 'bg-green-100 text-green-800';
                $statusText = 'Terbaca';
              } else {
                $statusClass = 'bg-yellow-100 text-yellow-800';
                $statusText = 'Belum Dibaca';
              }
          ?>
              <tr class='hover:bg-gray-50 dark:hover:bg-gray-800/80'>
                <td class='px-4 py-3'><?php echo $no ?></td>
                <td class='px-4 py-3'><?php echo $row['nama_lengkap'] ?></td>
                <td class='px-4 py-3'><?php echo $row['nim'] ?></td>
                <td class='px-4 py-3'><?php echo $row['angkatan'] ?></td>
                <td class='px-4 py-3'><?php echo $row['topik_permasalahan'] ?? '-' ?></td>
                <td class='px-4 py-3'>
                  <span class='px-2 py-1 text-xs font-medium rounded-full <?php echo $statusClass ?>'><?php echo $statusText ?></span>
                </td>
                <td class='px-4 py-3 text-center space-x-2'>
                  <button class="lihat-detail px-3 py-1 text-xs text-white bg-blue-500 rounded-lg hover:bg-blue-600" data-detail='<?php echo json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT); ?>'>
                    Lihat Detail
                  </button>
                  <button
                    class="edit-aspirasi px-3 py-1 text-xs text-white bg-green-500 rounded-lg hover:bg-green-600"
                    data-aspirasi='<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
                    Edit
                  </button>
                  <button
                    onclick="hapusAspirasi(<?= $row['id'] ?>)"
                    class="px-3 py-1 text-xs text-white bg-red-500 rounded-lg hover:bg-red-600">
                    Hapus
                  </button>
                </td>
              </tr>
            <?php
              $no++;
            }
          } else {
            ?>
            <tr>
              <td colspan='7' class='px-4 py-3 text-center text-gray-500'>Belum ada data aspirasi.</td>
            </tr>

          <?php }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div id="detailModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
      <h2 class="text-xl font-semibold mb-4 dark:text-black">Detail Aspirasi</h2>
      <div id="detailContent" class="space-y-2 text-sm text-gray-700"></div>
      <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
    </div>
  </div>

  <div id="editAspirasiModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 w-96">
      <h2 class="text-lg font-semibold mb-4 text-gray-700 dark:text-white">Edit Aspirasi</h2>
      <form action="action.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" id="editAspirasiId">

        <div>
          <label for="editStatus" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Status</label>
          <select id="editStatus" name="status" required
            class="w-full px-4 py-2 border border-gray-300 text-black rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <option value="belum dibaca">Belum Dibaca</option>
            <option value="terbaca">Terbaca</option>
          </select>
        </div>

        <div>
          <label for="editPihakTerkait" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Pihak Terkait</label>
          <input type="text" id="editPihakTerkait" name="pihak_terkait"
            class="w-full px-4 py-2 border border-gray-300 text-black rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" />
        </div>

        <div>
          <label for="editHasil" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">Hasil</label>
          <textarea id="editHasil" name="hasil" rows="3"
            class="w-full px-4 py-2 border border-gray-300 text-black rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
        </div>

        <div class="flex justify-end space-x-2 pt-2">
          <button type="button" onclick="tutupEditAspirasiModal()" class="px-4 py-2 text-sm bg-gray-300 hover:bg-gray-400 rounded-lg text-black">Batal</button>
          <button type="submit" name="submit_edit_aspirasi" class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>
