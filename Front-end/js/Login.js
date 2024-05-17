document.addEventListener('DOMContentLoaded', function () {
  const loginForm = document.getElementById('loginForm');

  loginForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const userName = document.getElementById('userName').value;
    const password = document.getElementById('password').value;

    if (!/^[a-zA-Z]{6}$/.test(userName) || !/^[a-zA-Z]{8}$/.test(password)) {
      document.getElementById('errorMessages').textContent = 'Usuário ou senha formatados incorretamente.';
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
          document.getElementById('errorMessages').textContent = data.message;
        }
      })
      .catch(error => {
        console.error('Erro ao enviar o formulário:', error);
        document.getElementById('errorMessages').textContent = 'Erro ao processar a solicitação.';
      });
  });
});


function limparCampos() {
  document.getElementById('userName').value = '';
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


