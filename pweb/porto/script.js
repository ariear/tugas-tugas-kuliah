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
