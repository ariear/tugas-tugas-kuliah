<?php
  include "koneksi.php";
  session_start();

  $topik_query = "SELECT * FROM TopikPermasalahan";
  $topik_data = $conn->query($topik_query);
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
              <a href="index.php" class="rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white">Form Serap</a>
              <a href="table.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white">Daftar hasil Serap</a>
            </div>
          </div>
        </div>

        <?php if (isset($_SESSION['admin_id'])) { ?>
          <a href="kelola_akun.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Kelola Akun</a>
          <a href="kelola_aspirasi.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white hidden sm:inline-block">Kelola Aspirasi</a>
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
        <a href="index.php" class="block rounded-md bg-gray-950/50 px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Form Serap</a>
        <a href="table.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Daftar Hasil Serap</a>
        <?php if (isset($_SESSION['admin_id'])) { ?>
          <a href="kelola_akun.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Kelola Akun</a>
          <a href="kelola_aspirasi.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-white/5 hover:text-white">Kelola Aspirasi</a>
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
    <h1 class="text-3xl font-bold mb-2">Form Serap Aspirasi Mahasiswa</h1>
    <p class="text-black/70 dark:text-white/80 mb-10">
      Sampaikan aspirasimu pada form di bawah ini yaww!!
    </p>

    <form action="action.php" method="POST" class="space-y-5 text-black">
      <div class="flex w-full">
        <div class="w-full">
          <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
            Nama Lengkap
          </label>
          <input type="text" id="nama" name="nama_lengkap" placeholder="Nama lengkap" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required />
        </div>

        <div class="w-full ml-5">
          <label for="nim" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
            NIM
          </label>
          <input type="text" id="nim" name="nim" placeholder="NIM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required />
        </div>
      </div>

      <div class="flex">
        <div class="w-full">
          <label for="angkatan" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
            Angkatan
          </label>
          <select id="angkatan" name="angkatan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            <option value="">Pilih angkatan</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
          </select>
        </div>

        <div class="w-full ml-5">
          <label for="topik" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
            Topik Permasalahan
          </label>
          <select id="topik" name="topik_permasalahan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
            <option value="">Pilih topik permasalahan</option>

            <?php if ($topik_data && $topik_data->num_rows > 0) { ?>
              <?php while ($row = $topik_data->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($row['id']); ?>">
                  <?php echo $row['judul']; ?>
                </option>
              <?php } ?>
            <?php } else { ?>
              <option value="">Belum ada topik</option>
            <?php } ?>
          </select>
        </div>
      </div>

      <div>
        <label for="kritik" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
          Kritik
        </label>
        <textarea id="kritik" name="kritik" rows="3" placeholder="Tuliskan kritik Anda..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
      </div>

      <div>
        <label for="saran" class="block text-sm font-medium text-gray-700 dark:text-white mb-1">
          Saran
        </label>
        <textarea id="saran" name="saran" rows="3" placeholder="Tuliskan saran Anda..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
      </div>

      <div class="pt-4">
        <button type="submit" name="submit_aspirasi" class="w-full bg-green-700/80 hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 cursor-pointer">
          Kirim
        </button>
      </div>
    </form>
  </div>

  <script src="script.js"></script>
</body>

</html>
