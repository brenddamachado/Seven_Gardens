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
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            switch (data.userType) {
              case 'Cliente':
                window.location.href = 'Usuario.html';
                break;
              case 'Colaborador':
              case 'Master':
                window.location.href = 'InterfaceMaster.html';
                break;
              default:
                mensagemErro.textContent = 'Tipo de usuário não reconhecido!';
            }
          } else {
            mensagemErro.textContent = data.message; // Mostra mensagem de erro retornada pelo servidor.
          }
        })
        .catch(error => {
          console.error('Erro ao enviar o formulário:', error);
          mensagemErro.textContent = 'Erro ao processar a solicitação.'; // Mensagem genérica para erro de conexão.
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

