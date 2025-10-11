const currentFile = window.location.pathname.split("/").pop();

// toggle dark mode
const toggleBtn = document.getElementById("themeToggle");
const sunIcon = document.getElementById("sunIcon");
const moonIcon = document.getElementById("moonIcon");
const htmlEl = document.documentElement;

function updateIcons() {
  if (htmlEl.classList.contains("dark")) {
    moonIcon.classList.add("hidden");
    sunIcon.classList.remove("hidden");
  } else {
    sunIcon.classList.add("hidden");
    moonIcon.classList.remove("hidden");
  }
}

if (
  localStorage.theme === "dark" ||
  (!("theme" in localStorage) &&
    window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
  htmlEl.classList.add("dark");
} else {
  htmlEl.classList.remove("dark");
}
updateIcons();

toggleBtn.addEventListener("click", () => {
  htmlEl.classList.toggle("dark");
  if (htmlEl.classList.contains("dark")) {
    localStorage.theme = "dark";
  } else {
    localStorage.theme = "light";
  }
  updateIcons();
});

// Toggle Mobile Menu
const menuToggle = document.getElementById("menuToggle");
const mobileMenu = document.getElementById("mobileMenu");
const iconOpen = document.getElementById("iconOpen");
const iconClose = document.getElementById("iconClose");

menuToggle.addEventListener("click", () => {
  const isOpen = mobileMenu.classList.toggle("hidden");
  menuToggle.setAttribute("aria-expanded", !isOpen);
  iconOpen.classList.toggle("hidden");
  iconClose.classList.toggle("hidden");
});

// popup detail aspirasi
if (currentFile === "table.php" || currentFile === "kelola_aspirasi.php") {
  const modal = document.getElementById("detailModal");
  const modalContent = document.getElementById("detailContent");
  const closeModal = document.getElementById("closeModal");

  document.querySelectorAll(".lihat-detail").forEach((btn) => {
    btn.addEventListener("click", () => {
      const data = JSON.parse(btn.dataset.detail);

      modalContent.innerHTML = `
  <p><strong>Nama Lengkap:</strong> ${data.nama_lengkap}</p>
  <p><strong>NIM:</strong> ${data.nim}</p>
  <p><strong>Angkatan:</strong> ${data.angkatan}</p>
  <p><strong>Topik Permasalahan:</strong> ${data.topik_permasalahan}</p>
  <p><strong>Kritik:</strong> ${data.kritik || "-"}</p>
  <p><strong>Saran:</strong> ${data.saran || "-"}</p>
  <p><strong>Status:</strong> ${data.status}</p>
  <p><strong>Pihak terkait:</strong> ${data.pihak_terkait || "-"}</p>
  <p><strong>Hasil:</strong> ${data.hasil || "-"}</p>
  <p><strong>Tanggal Dibuat:</strong> ${data.tanggal_dibuat}</p>
  `;

      modal.classList.remove("hidden");
      modal.classList.add("flex");
    });
  });

  closeModal.addEventListener("click", () => {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
  });

  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.classList.add("hidden");
      modal.classList.remove("flex");
    }
  });
}

// kelola akun
document.querySelectorAll(".edit-admin").forEach((button) => {
  button.addEventListener("click", function () {
    console.log("njir");
    const id = this.getAttribute("data-id");
    const nama = this.getAttribute("data-nama");

    document.getElementById("editId").value = id;
    document.getElementById("editNama").value = nama;
    document.getElementById("editModal").classList.remove("hidden");
  });
});

function tutupModal() {
  document.getElementById("editModal").classList.add("hidden");
}

function hapusAdmin(id) {
  if (confirm("Yakin ingin menghapus admin ini?")) {
    window.location.href = "action.php?id_admin_delete=" + id;
  }
}

const btnTambahAdmin = document.getElementById("btnTambahAdmin");
const tambahModal = document.getElementById("tambahModal");

if (btnTambahAdmin && tambahModal) {
  btnTambahAdmin.addEventListener("click", () => {
    tambahModal.classList.remove("hidden");
    tambahModal.classList.add("flex");
  });
}

function tutupTambahModal() {
  tambahModal.classList.add("hidden");
  tambahModal.classList.remove("flex");
}

// kelola topik
const btnTambahTopik = document.getElementById("btnTambahTopik");
const tambahModalTopik = document.getElementById("tambahModalTopik");

if (btnTambahTopik) {
  btnTambahTopik.addEventListener("click", () => {
    tambahModalTopik.classList.remove("hidden");
    tambahModalTopik.classList.add("flex");
  });
}
function tutupTambahModalTopik() {
  tambahModalTopik.classList.add("hidden");
  tambahModalTopik.classList.remove("flex");
}

const editModalTopik = document.getElementById("editModalTopik");
document.querySelectorAll(".edit-topik").forEach((btn) => {
  btn.addEventListener("click", () => {
    document.getElementById("editId").value = btn.dataset.id;
    document.getElementById("editJudul").value = btn.dataset.judul;
    editModalTopik.classList.remove("hidden");
    editModalTopik.classList.add("flex");
  });
});
function tutupEditModalTopik() {
  editModalTopik.classList.add("hidden");
  editModalTopik.classList.remove("flex");
}

function hapusTopik(id) {
  if (confirm("Apakah Anda yakin ingin menghapus topik ini?")) {
    window.location.href = "action.php?hapus_topik=" + id;
  }
}

// kelola aspirasi
const editModalAspirasi = document.getElementById("editAspirasiModal");
const editButtonsAspirasi = document.querySelectorAll(".edit-aspirasi");

editButtonsAspirasi.forEach((btn) => {
  btn.addEventListener("click", () => {
    const data = JSON.parse(btn.dataset.aspirasi);

    document.getElementById("editAspirasiId").value = data.id;
    document.getElementById("editStatus").value = data.status ?? "belum dibaca";
    document.getElementById("editPihakTerkait").value =
      data.pihak_terkait ?? "";
    document.getElementById("editHasil").value = data.hasil ?? "";

    editModalAspirasi.classList.remove("hidden");
    editModalAspirasi.classList.add("flex");
  });
});

function tutupEditAspirasiModal() {
  editModalAspirasi.classList.add("hidden");
  editModalAspirasi.classList.remove("flex");
}

function hapusAspirasi(id) {
  if (confirm("Apakah Anda yakin ingin menghapus aspirasi ini?")) {
    window.location.href = "action.php?hapus_aspirasi=" + id;
  }
}
