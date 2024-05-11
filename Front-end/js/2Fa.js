document.addEventListener('DOMContentLoaded', function () {
  const form2FA = document.getElementById('2faForm');

  form2FA.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('../../Back-end/processo2Fa.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          // Redireciona com base no tipo de usuário
          if (data.userType === 'Cliente') {
            window.location.href = 'Usuario.html';
          } else if (data.userType === 'Colaborador' || data.userType === 'Master') {
            window.location.href = 'InterfaceMaster.html';
          }
        } else {
          document.getElementById('mensagemErro').textContent = data.message;
        }
      })
      .catch(error => {
        console.error('Erro ao enviar o formulário:', error);
        document.getElementById('mensagemErro').textContent = 'Erro ao processar a solicitação.';
      });
  });
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


