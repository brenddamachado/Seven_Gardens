
// Início do Carrossel
let slideIndex = 0; // Índice do slide atual

// Função para avançar para o próximo slide
function nextSlide() {
  showSlides(slideIndex += 1);
}

// Função para retroceder para o slide anterior
function prevSlide() {
  showSlides(slideIndex -= 1);
}

// Função para mostrar o slide atual
function showSlides(n) {
  const slides = document.getElementsByClassName("carousel-item");
  // Se chegarmos ao último slide, voltamos ao primeiro
  if (n >= slides.length) {
    slideIndex = 0;
  }
  // Se estivermos no slide anterior ao primeiro, voltamos ao último
  if (n < 0) {
    slideIndex = slides.length - 1;
  }
  // Ocultar todos os slides
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  // Mostrar o slide atual
  slides[slideIndex].style.display = "block";
}

// Avançar automaticamente para o próximo slide a cada 5 segundos
setInterval(nextSlide, 5000);

// Fim do Carrossel



//hamburguer menu
let hamburger = document.getElementById('hamburguer');
let mobileMenu = document.getElementById('mobile');
let closeButton = document.querySelector('.close-btn');

hamburger.addEventListener('click', function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener('click', function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});






