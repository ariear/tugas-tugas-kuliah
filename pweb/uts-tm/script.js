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
