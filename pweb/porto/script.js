const track = document.querySelector(".slider-track");
const slides = document.querySelectorAll(".slide");
let currentIndex = 0;
const totalSlides = slides.length;

function moveSlide() {
  currentIndex = (currentIndex + 1) % totalSlides;
  const offset = -currentIndex * 700;
  track.style.transform = `translateX(${offset}px)`;
}
setInterval(moveSlide, 4000);

const header = document.querySelector("header");
window.addEventListener("scroll", () => {
  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

const hamburger = document.getElementById("hamburger");
const mobileMenu = document.querySelector(".mobile-menu");

hamburger.addEventListener("click", () => {
  mobileMenu.classList.toggle("active");
});

document.querySelectorAll(".mobile-menu a").forEach((link) => {
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
  });
});
