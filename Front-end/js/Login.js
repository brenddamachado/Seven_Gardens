document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');

  loginForm.addEventListener('submit', function (event) {
    event.preventDefault();  // Prevenir o envio padrão do formulário

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Validar comprimento e caracteres do nome de usuário e senha
    if (!/^[a-zA-Z]{6}$/.test(email)) {
      alert('O nome de usuário deve ter exatamente 6 caracteres alfabéticos.');
      return;
    }
    if (!/^[a-zA-Z]{8}$/.test(password)) {
      alert('A senha deve ter exatamente 8 caracteres alfabéticos.');
      return;
    }

    // Preparar dados para envio
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);

    // Enviar os dados para o servidor via AJAX
    fetch('Login.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Redirecionar para a página de 2FA, caso necessário
          window.location.href = '2FA.php';
        } else {
          alert(data.message);  // Exibir mensagem de erro
        }
      })
      .catch(error => console.error('Erro ao enviar o formulário:', error));
  });
});

function limparCampos() {
  document.getElementById('email').value = '';
  document.getElementById('password').value = '';
}




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


