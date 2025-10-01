// navbar
const navbar = document.querySelector("header");

window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    navbar.classList.add("border-b", "border-[#F7C35F]");
  } else {
    navbar.classList.remove("border-b", "border-[#F7C35F]");
  }
});

// projects slide
const slider = document.getElementById("slider");
const next = document.getElementById("next");
const prev = document.getElementById("prev");

let index = 0;
const totalSlides = slider.children.length;

function updateSlider() {
  slider.style.transform = `translateX(-${index * 100}%)`;
}

next.addEventListener("click", () => {
  index = (index + 1) % totalSlides;
  updateSlider();
});

prev.addEventListener("click", () => {
  index = (index - 1 + totalSlides) % totalSlides;
  updateSlider();
});

// testimonials slide
const sliderTesti = document.getElementById("slider-testi");
const indicators = document.querySelectorAll("#indicators span");
let indexTesti = 0;
const totalSlidesTesti = sliderTesti.children.length;

function showSlide(i) {
  sliderTesti.style.transform = `translateX(-${i * 100}%)`;
  indicators.forEach((dot, idx) => {
    dot.classList.toggle("opacity-100", idx === i);
    dot.classList.toggle("opacity-40", idx !== i);
  });
}

function nextSlide() {
  indexTesti = (indexTesti + 1) % totalSlidesTesti;
  showSlide(indexTesti);
}

setInterval(() => {
  index = (index + 1) % totalSlides;
  updateSlider();

  nextSlide();
}, 3000);
