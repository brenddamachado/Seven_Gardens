
let hamburger = document.getElementById("hamburguer");
let mobileMenu = document.getElementById("mobile");
let closeButton = document.querySelector(".close-btn");

hamburger.addEventListener("click", function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener("click", function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});
