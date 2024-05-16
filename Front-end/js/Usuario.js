document.addEventListener('DOMContentLoaded', function () {
  // Seleciona todas as abas e todos os conteúdos de abas
  const tabs = document.querySelectorAll('.barra-lateral a');
  const contents = document.querySelectorAll('.secao');

  // Função para remover a classe 'active' de todas as abas e ocultar todos os conteúdos
  function deactivateAllTabs() {
    tabs.forEach(tab => tab.classList.remove('active'));
    contents.forEach(content => content.style.display = 'none');
  }

  // Adiciona o evento de clique a cada aba
  tabs.forEach(tab => {
    tab.addEventListener('click', function (e) {
      e.preventDefault();
      deactivateAllTabs();
      // Adiciona a classe 'active' à aba clicada e mostra o conteúdo correspondente
      this.classList.add('active');
      const activeContent = document.querySelector(this.getAttribute('href'));
      if (activeContent) {
        activeContent.style.display = 'block';
      }
    });
  });

  // Ativa a primeira aba por padrão
  if (tabs.length > 0) {
    tabs[0].click();
  }
});



// HAMBURGUER JS

let hamburger = document.getElementById("hamburguer");
let mobileMenu = document.getElementById("mobile");
let closeButton = document.querySelector(".close-btn");

hamburger.addEventListener("click", function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener("click", function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});


