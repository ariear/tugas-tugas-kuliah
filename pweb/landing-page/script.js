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

setInterval(() => {
  index = (index + 1) % totalSlides;
  updateSlider();
}, 3000);
