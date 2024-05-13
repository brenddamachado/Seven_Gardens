document.addEventListener('DOMContentLoaded', function () {
  const form2FA = document.getElementById('2faForm');
  const mensagemErro = document.getElementById('mensagemErro');

  if (form2FA) {
    form2FA.addEventListener('submit', function (event) {
      event.preventDefault();

      const resposta = document.getElementById('resposta').value.trim();
      if (resposta === "") {
        mensagemErro.textContent = "Por favor, preencha a resposta.";
        return;
      }

      const formData = new FormData(this);

      fetch('../../Back-end/processo2Fa.php', {
        method: 'POST',
        body: formData
      })
        .then(response => {
          console.log('Resposta bruta:', response.clone().text()); // Clona a resposta para logar o texto bruto.
          return response.json();
        })
        .then(data => {
          // sua lógica aqui
        })
        .catch(error => {
          console.error('Erro ao enviar o formulário:', error);
        });

    });
  }
});



// Manipulação do menu tipo hambúrguer
const hamburger = document.getElementById("hamburguer");
const mobileMenu = document.getElementById("mobile");
const closeButton = document.querySelector(".close-btn");

if (hamburger && mobileMenu && closeButton) {
  hamburger.addEventListener("click", function () {
    mobileMenu.style.left = "0"; // Abre o menu
  });

  closeButton.addEventListener("click", function () {
    mobileMenu.style.left = "-100%"; // Fecha o menu
  });
}

