document.addEventListener('DOMContentLoaded', function () {
  const tabs = document.querySelectorAll('.tabs a');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
      tab.addEventListener('click', function (e) {
          e.preventDefault(); // Previne o scroll automático

          // Desativa todos os tabs e conteúdos
          tabs.forEach(t => t.classList.remove('active'));
          tabContents.forEach(content => content.style.display = 'none');

          // Ativa o tab clicado
          this.classList.add('active');
          const activeTabContent = document.querySelector(this.getAttribute('href'));
          if (activeTabContent) {
              activeTabContent.style.display = 'block';
          }
      });
  });

  // Simula um clique no primeiro tab para inicializar o conteúdo
  if (tabs.length > 0) {
      tabs[0].click();
  }
});

/*mobile */
let hamburger = document.getElementById('hamburguer');
let mobileMenu = document.getElementById('mobile');
let closeButton = document.querySelector('.close-btn');

hamburger.addEventListener('click', function() {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener('click', function() {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});
