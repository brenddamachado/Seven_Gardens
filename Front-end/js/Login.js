document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');
  const userNameInput = document.getElementById('userName');
  const passwordInput = document.getElementById('password');
  const userNameError = document.getElementById('userNameError');
  const passwordError = document.getElementById('passwordError');
  const generalError = document.getElementById('errorMessages');

  loginForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const userName = userNameInput.value;
    const password = passwordInput.value;
    let isValid = true;

    // Validando o nome de usuário
    if (!/^[a-zA-Z]{6}$/.test(userName)) {
      userNameError.textContent = 'O nome de usuário deve conter apenas 6 caracteres alfabéticos.';
      userNameError.style.display = 'inline'; // Exibindo a mensagem de erro específica para o nome de usuário
      isValid = false;
    } else {
      userNameError.style.display = 'none'; // Ocultando a mensagem de erro específica para o nome de usuário se o campo estiver correto
    }

    // Validando a senha
    if (!/^[a-zA-Z]{8}$/.test(password)) {
      passwordError.textContent = 'A senha deve conter apenas 8 caracteres alfabéticos.';
      passwordError.style.display = 'inline'; // Exibindo a mensagem de erro específica para a senha
      isValid = false;
    } else {
      passwordError.style.display = 'none'; // Ocultando a mensagem de erro específica para a senha se o campo estiver correto
    }

    if (!isValid) {
      generalError.textContent = 'Por favor, corrija os erros no formulário.';
      generalError.style.display = 'inline'; // Exibindo a mensagem de erro geral
      return;
    }

    const formData = new FormData();
    formData.append('userName', userName);
    formData.append('password', password);

    fetch('../../Back-end/processoLogin.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          window.location.href = '2Fa.php';
        } else {
          generalError.textContent = data.message; // Atualizando a mensagem de erro geral com a mensagem do servidor
          generalError.style.display = 'inline'; // Exibindo a mensagem de erro geral
        }
      })
      .catch(error => {
        console.error('Erro ao enviar o formulário:', error);
        generalError.textContent = 'Erro ao processar a solicitação.';
        generalError.style.display = 'inline'; // Exibindo a mensagem de erro geral
      });
  });
});

function limparCampos() {
  document.getElementById('userName').value = '';
  document.getElementById('password').value = '';
  document.getElementById('userNameError').style.display = 'none'; // Ocultando a mensagem de erro específica
  document.getElementById('passwordError').style.display = 'none'; // Ocultando a mensagem de erro específica
  document.getElementById('errorMessages').style.display = 'none'; // Ocultando a mensagem de erro geral
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
})